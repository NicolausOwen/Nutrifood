<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            // Check for rate limiting
            $this->checkRateLimit($request);

            // Attempt authentication
            $request->authenticate();

            // Clear rate limit on successful login
            RateLimiter::clear($this->throttleKey($request));

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard', absolute: false));

        } catch (ValidationException $e) {
            // Handle authentication failure
            $this->incrementRateLimit($request);

            // Get the specific error message
            $errorMessage = $this->getErrorMessage($e, $request);

            return back()->withErrors([
                'login' => $errorMessage
            ])->withInput($request->only('email'));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Get the rate limiting throttle key for the given request.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
    }

    /**
     * Check if the login request is rate limited.
     */
    protected function checkRateLimit(Request $request): void
    {
        $key = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);

            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$minutes} menit.",
            ]);
        }
    }

    /**
     * Increment the rate limit for the given request.
     */
    protected function incrementRateLimit(Request $request): void
    {
        RateLimiter::hit($this->throttleKey($request), 900); // 15 minutes
    }

    /**
     * Get appropriate error message based on the exception.
     */
    protected function getErrorMessage(ValidationException $e, Request $request): string
    {
        $key = $this->throttleKey($request);
        $attempts = RateLimiter::attempts($key);

        // Check if it's a rate limit error
        if (isset($e->errors()['email']) && str_contains($e->errors()['email'][0], 'Terlalu banyak')) {
            return $e->errors()['email'][0];
        }

        // Progressive error messages based on attempts
        if ($attempts >= 4) {
            return 'Email atau password salah. Akun akan dikunci setelah 1 percobaan lagi.';
        } elseif ($attempts >= 2) {
            return 'Email atau password yang Anda masukkan salah. Periksa kembali kredensial Anda.';
        } else {
            return 'Email atau password yang Anda masukkan salah!';
        }
    }
}