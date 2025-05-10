{{-- resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="transition-colors duration-500">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 Not Found</title>

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">

    {{-- Tailwind CSS --}}
    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.7s ease-out forwards;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-cyan-400 to-green-500 dark:from-gray-900 dark:to-gray-800 min-h-screen flex items-center justify-center px-6 py-10 text-white dark:text-gray-200 transition-colors duration-500">
    <div class="text-center animate-fade-in">

        {{-- Ilustrasi SVG --}}
        <div class="mb-6">
            <svg class="mx-auto w-40 h-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M9 10h.01M15 10h.01M12 17a5 5 0 0 0 5-5V6a5 5 0 0 0-10 0v6a5 5 0 0 0 5 5z" />
            </svg>
        </div>

        {{-- Judul dan Deskripsi --}}
        <h1 class="text-6xl font-extrabold mb-4 drop-shadow-lg">404</h1>
        <p class="text-xl mb-6">Halaman yang kamu cari tidak ditemukan 😢</p>

        {{-- Tombol Kembali --}}
        <a href="{{ url('/') }}"
            class="inline-block px-6 py-3 bg-white text-cyan-600 font-semibold rounded-xl shadow-lg hover:bg-cyan-100 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition-all transform hover:scale-105 duration-300">
            ⬅️ Kembali ke Beranda
        </a>
    </div>
</body>

</html>
