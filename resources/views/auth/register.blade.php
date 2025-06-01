<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body {
        font-family: "Montserrat", sans-serif;
        background-color: #d0d0d0;
      }

      .hilo-blue {
        background-color: #1a3a8f;
      }

      .hilo-yellow {
        background-color: #ccdb00;
      }

      .password-eye {
        cursor: pointer;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
      }

      .exercise-image {
        pointer-events: none;
      }

      .right-panel-image {
        filter: contrast(1.15) brightness(1.08)
          drop-shadow(0 6px 8px rgba(0, 0, 0, 0.45));
        -webkit-filter: contrast(1.15) brightness(1.08)
          drop-shadow(0 6px 8px rgba(0, 0, 0, 0.45));
      }

      .error-message {
        animation: fadeInDown 0.3s ease-in-out;
      }

      .success-message {
        animation: fadeInDown 0.3s ease-in-out;
      }

      @keyframes fadeInDown {
        from {
          opacity: 0;
          transform: translateY(-10px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .shake-animation {
        animation: shake 0.5s ease-in-out;
      }

      @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
      }

      @media (max-width: 640px) {
        .left-panel-image-top {
          max-width: 180px;
          opacity: 0.9;
        }

        .left-panel-image-bottom {
          max-width: 160px;
          opacity: 0.9;
          transform: translateY(-10px);
        }

        .mobile-bigger-image {
          transform: scale(1.4);
        }
      }
      .exercise-image {
        pointer-events: none;
      }
    </style>

    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primaryColor: "#203E99",
              secondaryColor: "#BFD101",
              secondaryColorDark: "#8c9800",
            },
          },
        },
      };
    </script>
  </head>

  <body class="min-h-screen relative">
    <div class="flex flex-col lg:flex-row min-h-screen w-full overflow-hidden">
      <!-- Left Panel -->
      <div
        class="hilo-blue w-full lg:w-1/2 h-64 sm:h-80 lg:h-auto relative flex items-center justify-center pb-6"
      >
        <!-- Exercise figure illustrations -->
        <div class="absolute top-0 right-0 transform rotate-[-30deg]">
          <img
            src="{{ asset('images/excercise 2.png') }}"
            alt="Exercise Figure 1"
            class="w-48 sm:w-72 md:w-96 lg:w-96 opacity-95 left-panel-image-top exercise-image"
          />
        </div>

        <div
          class="absolute bottom-0 left-0 transform translate-x-0 translate-y-0"
        >
          <img
            src="{{ asset('images/excecise 1.png') }}"
            alt="Exercise Figure 2"
            class="w-44 sm:w-56 md:w-72 opacity-95 left-panel-image-bottom exercise-image"
          />
        </div>

        <div class="z-10 w-full flex flex-col justify-center items-center">
          <!-- Stepper - Updated to 2 steps only -->
          <div class="mb-12 w-full absolute lg:top-20 top-10">
            <ol class="relative flex items-center w-full text-secondaryColor">
              <!-- Step 1 -->
              <li class="flex-1 text-center relative">
                <div
                  class="flex items-center justify-center w-6 h-6 mx-auto border-4 border-secondaryColor rounded-full z-10 bg-primaryColor"
                ></div>
                <p class="mt-4">Account Info</p>
                <div
                  class="absolute top-3 left-1/2 w-full h-[6px] bg-white -z-10"
                ></div>
              </li>

              <!-- Step 2 -->
              <li class="flex-1 text-center relative">
                <div
                  class="flex items-center justify-center w-6 h-6 mx-auto border-4 border-white rounded-full z-10 bg-primaryColor"
                ></div>
                <p class="mt-4 text-white">Personal Info</p>
              </li>
            </ol>
          </div>
          <!-- HiLo StrongFest Logo -->
          <div class="lg:mt-0 mt-40">
            <img
              src="{{ asset('images/LOGO StrongFest 2025-01 (1).png') }}"
              alt="HiLo StrongFest Logo"
              class="w-48 sm:w-56 md:w-64 h-auto"
              style="
                filter: drop-shadow(0 10px 8px rgba(0, 0, 0, 0.04))
                  drop-shadow(0 40px 30px rgba(0, 0, 0, 0.1))
                  drop-shadow(0 40px 20px rgba(0, 0, 0, 0.15));
              "
            />
          </div>
        </div>
      </div>

      <!-- Right Panel -->
      <div
        class="w-full lg:w-1/2 flex items-center justify-center relative px-4 md:px-8 py-10 lg:py-0"
        style="min-height: 540px"
      >
        <div class="relative z-10 w-full max-w-sm">
          <!-- HiLo x HIMSI Logo -->
          <div class="flex justify-center items-center mb-6 sm:mb-8">
            <div
              class="relative w-48 sm:w-56 md:w-64 h-12 sm:h-16 flex items-center justify-center"
            >
              <img
                src="{{ asset('images/LOGO.png') }}"
                alt="HiLo x HIMSI Logo"
                class="w-full h-full object-contain"
                style="
                  filter: drop-shadow(0 10px 8px rgba(0, 0, 0, 0.04))
                    drop-shadow(0 4px 3px rgba(0, 0, 0, 0.1))
                    drop-shadow(0 20px 12px rgba(0, 0, 0, 0.15));
                "
              />
            </div>
          </div>

          <!-- Global Error Alert -->
          @if($errors->any())
          <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-400 rounded-md error-message">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">
                  Registration Error
                </h3>
                <div class="mt-2 text-sm text-red-700">
                  <ul class="list-disc space-y-1 pl-5">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          @endif

          <!-- Success Message (jika ada) -->
          @if(session('success'))
          <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-400 rounded-md success-message">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                  {{ session('success') }}
                </p>
              </div>
            </div>
          </div>
          @endif

          <div
            class="hilo-yellow rounded-lg p-5 sm:p-6 md:p-8 border-4 border-blue-900 w-full shadow-2xl mb-16 lg:mb-0"
            id="register-form-container"
          >
            <h2
              class="text-center text-blue-900 font-bold text-xl sm:text-2xl mb-6"
            >
              Register
            </h2>
            <form method="POST" action="{{ route('register') }}" id="register-form">
              @csrf
              <!-- Email Input -->
              <div class="mb-4">
                <label
                  for="email"
                  class="block text-blue-900 text-sm font-bold mb-1"
                  >Email</label
                >
                <input
                  type="email"
                  id="email"
                  name="email"
                  value="{{ old('email') }}"
                  placeholder="Example@email.com"
                  class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-bold text-sm
                    @error('email') border-red-500 bg-red-50 @else border-gray-300 @enderror"
                />
                @error('email')
                <p class="text-red-500 text-xs font-semibold mt-1 error-message">
                  {{ $message }}
                </p>
                @enderror
              </div>

              <!-- Password Input -->
              <div class="mb-3">
                <label
                  for="password"
                  class="block text-blue-900 text-sm font-bold mb-1"
                  >Password</label
                >
                <div class="relative">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="at least 8 characters"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-bold text-sm pr-10
                      @error('password') border-red-500 bg-red-50 @else border-gray-300 @enderror"
                  />
                  <span class="password-eye" onclick="togglePassword()">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="18"
                      height="18"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      id="password-eye-icon"
                    >
                      <path
                        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                      ></path>
                      <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                  </span>
                </div>
                @error('password')
                <p class="text-red-500 text-xs font-semibold mt-1 error-message">
                  {{ $message }}
                </p>
                @enderror
              </div>

              <!-- Confirm Password Input -->
              <div class="mb-3">
                <label
                  for="confirm-password"
                  class="block text-blue-900 text-sm font-bold mb-1"
                  >Confirm Password</label
                >
                <div class="relative">
                  <input
                    type="password"
                    id="confirm-password"
                    name="password_confirmation"
                    placeholder="re-type your password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-bold text-sm pr-10"
                  />
                  <span class="password-eye" onclick="toggleConfirmPassword()">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="18"
                      height="18"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      id="confirm-password-eye-icon"
                    >
                      <path
                        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                      ></path>
                      <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                  </span>
                </div>
                <p
                  id="confirm-error"
                  class="text-red-500 text-xs font-semibold mt-1 hidden"
                >
                  Passwords do not match
                </p>
              </div>

              <!-- Buttons Container -->
              <div
                class="mt-5 sm:mt-6 z-50 flex flex-col sm:flex-row gap-3 sm:gap-4"
              >
                <button
                  type="submit"
                  id="submit-btn"
                  class="flex-1 bg-[#203e99] text-white py-2 px-3 rounded-lg hover:bg-[#102b6b] transition-all duration-300 font-bold text-sm sm:text-base shadow-md hover:shadow-lg transform hover:-translate-y-0.5 border-2 border-[#102b6b] disabled:bg-gray-400 disabled:cursor-not-allowed disabled:transform-none"
                >
                  <span id="btn-text">Next</span>
                  <span id="btn-loading" class="hidden">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                  </span>
                </button>

                <a
                  href="/"
                  class="flex-1 bg-gradient-to-r from-gray-700 to-gray-800 text-white py-2 px-3 rounded-lg hover:from-gray-800 hover:to-gray-900 transition-all duration-300 font-bold text-xs sm:text-sm text-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5 border-2 border-gray-900"
                >
                  Back To Homepage
                </a>
              </div>
            </form>
            <div class="text-center mt-10 font-bold">
              Already Have an Account?
              <a href="/login" class="text-blue-900 hover:underline transition-all duration-200">Login</a>
            </div>
          </div>
        </div>

        <!-- Bottom Figures -->
        <div
          class="absolute bottom-0 left-0 transform -translate-x-1/4 translate-y-12 sm:translate-y-8 z-0"
        >
          <img
            src="{{ asset('images/lineart-08.png') }}"
            alt="Exercise Figure 3"
            class="w-48 sm:w-48 md:w-64 lg:w-80 h-auto opacity-95 sm:opacity-100 exercise-image right-panel-image mobile-bigger-image pointer-events-none"
          />
        </div>

        <div
          class="absolute bottom-0 transform translate-y-24 sm:translate-y-20 md:translate-y-24 lg:translate-y-28 right-0 p-1 sm:p-2 md:p-4 z-0"
        >
          <img
            src="{{ asset('images/tendang.png') }}"
            alt="Exercise Figure"
            class="w-64 sm:w-64 md:w-80 lg:w-96 h-auto object-contain opacity-95 sm:opacity-100 exercise-image right-panel-image mobile-bigger-image pointer-events-none"
          />
        </div>
      </div>
    </div>

    <!-- Mobile-only divider -->
    <div class="lg:hidden absolute bottom-0 left-0 right-0 z-20">
      <div
        class="mx-auto w-4/5 h-1 bg-gradient-to-r from-transparent via-gray-400 to-transparent rounded-full opacity-60"
      ></div>
    </div>

    <!-- Mobile-only fitness quote -->
    <div
      class="lg:hidden absolute bottom-3 left-0 right-0 text-center z-20 px-4 font-bold"
    >
      <p
        class="text-xl"
        style="
          background: linear-gradient(90deg, #1a3a8f 0%, #ccdb00 100%);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1);
        "
      >
        FIGHT SARCOPENIA
      </p>
    </div>

    <script>
      function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("password-eye-icon");

        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          eyeIcon.innerHTML = `
            <path d="M17.94 17.94A10.07 10.07 0 01 12 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"></path>
            <line x1="1" y1="1" x2="23" y2="23"></line>
          `;
        } else {
          passwordInput.type = "password";
          eyeIcon.innerHTML = `
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>
          `;
        }
      }

      function toggleConfirmPassword() {
        const confirmPasswordInput = document.getElementById("confirm-password");
        const eyeIcon = document.getElementById("confirm-password-eye-icon");

        if (confirmPasswordInput.type === "password") {
          confirmPasswordInput.type = "text";
          eyeIcon.innerHTML = `
            <path d="M17.94 17.94A10.07 10.07 0 01 12 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"></path>
            <line x1="1" y1="1" x2="23" y2="23"></line>
          `;
        } else {
          confirmPasswordInput.type = "password";
          eyeIcon.innerHTML = `
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>
          `;
        }
      }

      // Enhanced form validation
      document.getElementById("register-form").addEventListener("submit", function (e) {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm-password").value;
        const confirmError = document.getElementById("confirm-error");
        const confirmInput = document.getElementById("confirm-password");
        const submitBtn = document.getElementById("submit-btn");
        const btnText = document.getElementById("btn-text");
        const btnLoading = document.getElementById("btn-loading");

        if (password !== confirmPassword) {
          e.preventDefault();
          confirmError.classList.remove("hidden");
          confirmInput.classList.add("border-red-500", "bg-red-50", "shake-animation");

          // Remove shake animation after it completes
          setTimeout(() => {
            confirmInput.classList.remove("shake-animation");
          }, 500);

          return false;
        } else {
          confirmError.classList.add("hidden");
          confirmInput.classList.remove("border-red-500", "bg-red-50");
        }

        // Show loading state
        submitBtn.disabled = true;
        btnText.classList.add("hidden");
        btnLoading.classList.remove("hidden");
      });

      // Real-time password confirmation validation
      document.getElementById("confirm-password").addEventListener("input", function() {
        const password = document.getElementById("password").value;
        const confirmPassword = this.value;
        const confirmError = document.getElementById("confirm-error");

        if (confirmPassword && password !== confirmPassword) {
          confirmError.classList.remove("hidden");
          this.classList.add("border-red-500", "bg-red-50");
        } else {
          confirmError.classList.add("hidden");
          this.classList.remove("border-red-500", "bg-red-50");
        }
      });

      // Clear error states when user starts typing
      document.getElementById("email").addEventListener("input", function() {
        this.classList.remove("border-red-500", "bg-red-50");
      });

      document.getElementById("password").addEventListener("input", function() {
        this.classList.remove("border-red-500", "bg-red-50");
      });

      // Auto-hide error messages after 10 seconds
      setTimeout(function() {
        const errorMessages = document.querySelectorAll('.error-message, .success-message');
        errorMessages.forEach(function(msg) {
          msg.style.transition = 'opacity 0.5s ease-out';
          msg.style.opacity = '0';
          setTimeout(() => msg.remove(), 500);
        });
      }, 10000);
    </script>
  </body>
</html>