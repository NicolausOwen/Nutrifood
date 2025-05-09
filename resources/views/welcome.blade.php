<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HILO STRONGFEST</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>


<body>
    @include('layouts.navbar')
<div class="container mx-auto px-8 py-12 max-w-6xl">

    <!-- DESCRITION -->
    <section class="py-24">
        <!-- ELEMENT LARI -->
        <img src="{{ asset('images/Lineart-08.png') }}" class="absolute w-[65vw] left-[-25vw] top-[10vh] opacity-10" alt="">
        <!-- ELEMENT LARI -->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[70px] items-center">
            <div data-aos="fade-right" data-aos-duration="1000">
                <h2 class="text-6xl font-extrabold text-black-800 mb-5">Apa Itu StrongFest?</h2>
                <p class="text-black-700 leading-relaxed">
                    Intel (Intelligence and Technology) adalah komunitas mahasiswa Fakultas Ilmu Komputer Unsri yang berfokus pada pengembangan teknologi, kreativitas, dan inovasi. Kami menjadi wadah bagi mahasiswa untuk mengembangkan kemampuan teknis, soft skills, dan jaringan profesional di bidang teknologi informasi.
                </p>
                <p class="text-black-700 leading-relaxed mt-4">
                    Sejak berdiri pada tahun 2010, Intel telah menghasilkan banyak talenta-talenta berbakat yang berkontribusi di berbagai perusahaan teknologi ternama maupun startup lokal.
                </p>
            </div>

            <div class="relative" data-aos="fade-left" data-aos-duration="1000">
                <img src="{{ asset('images/LOGO StrongFest 2025-01 (1).png') }}"
                     alt="Tim Intel Fasilkom Unsri"
                     class="w-[450px] h-auto">
            </div>
        </div>
    </section>
    <!-- DESCRITION -->

    <!-- COLLABORATION -->
     <section class="py-24">
       <!-- ELEMENT Terajang -->
       <img src="{{ asset('images/tendang.png') }}" class="absolute opacity-10 w-[65vw] right-[-8vw] top-[65vh]" alt="">
       <!-- ELEMENT TERAJANG -->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-[70px] items-center">
            <div class="relative" data-aos="fade-right" data-aos-duration="1000">
                <img src="{{ asset('images/LOGO.png') }}"
                     alt="Tim HIMSI Fasilkom Unsri"
                     class="w-[450px] h-auto">
            </div>
            <div data-aos="fade-left" data-aos-duration="1000">
                <h4 class="text-3xl font-extrabold text-black-100 mb-5">COLLABORATION IN AMBITION</h4>
                <p class="text-black-700 leading-relaxed">
                    Intel (Intelligence and Technology) adalah komunitas mahasiswa Fakultas Ilmu Komputer Unsri yang berfokus pada pengembangan teknologi, kreativitas, dan inovasi. Kami menjadi wadah bagi mahasiswa untuk mengembangkan kemampuan teknis, soft skills, dan jaringan profesional di bidang teknologi informasi.
                </p>
                <p class="text-black-700 leading-relaxed mt-4">
                    Sejak berdiri pada tahun 2010, Intel telah menghasilkan banyak talenta-talenta berbakat yang berkontribusi di berbagai perusahaan teknologi ternama maupun startup lokal.
                </p>
            </div>
        </div>
    </section>
    <!-- COLLABORATION -->

    <!-- OUR SOCIAL MEDIA -->
    <section class="py-24">
       <!-- ELEMENT BARBEL -->
       <img src="{{ asset('images/excecise 1.png') }}" class="absolute opacity-10 left-[-25vw] w-[60vw] top-[150vh]" alt="">
       <img src="{{ asset('images/excercise 2.png') }}" class="absolute opacity-10 w-[60vw] right-[-18vw] top-[220vh] " alt="">
       <!-- ELEMENT BARBEL -->
        <div data-aos="fade-up" data-aos-duration="1000">
            <h2 class="text-5xl font-extrabold text-black-800 text-center mb-5 py-12">Our Social Media</h2>
        </div>
        <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] h-[600px] w-[300px] shadow-xl" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
            <div class="w-[148px] h-[18px] bg-gray-800 top-0 rounded-b-[1rem] left-1/2 -translate-x-1/2 absolute"></div>
            <div class="h-[46px] w-[3px] bg-gray-800 absolute -start-[17px] top-[124px] rounded-s-lg"></div>
            <div class="h-[46px] w-[3px] bg-gray-800 absolute -start-[17px] top-[178px] rounded-s-lg"></div>
            <div class="h-[64px] w-[3px] bg-gray-800 absolute -end-[17px] top-[142px] rounded-e-lg"></div>
            <div class="rounded-[2rem] overflow-hidden w-[272px] h-[572px] bg-white dark:bg-gray-800">
                <img src="{{ asset('images/socialmedia.png') }}" class="dark:hidden w-[272px] h-[572px]" alt="">
                <img src="{{ asset('images/socialmedia.png') }}" class="hidden dark:block w-[272px] h-[572px]" alt="">
            </div>
        </div>

    </section>
    <!-- OUR SOCIAL MEDIA -->
</div>
@include('layouts.footer')

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>