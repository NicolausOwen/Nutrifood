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
                [Sarcopenia] Loss of muscle mass and strength due to aging process and may resulted in low physical performance. Start at the age 30th, Muscle loss 3-8% /decade. START PREVENTION WITH A HEALTHIER LIFESTYLE!
                </p>
                <p class="text-black-700 leading-relaxed mt-4">
                Acara ini akan dilaksanakan di Hotel Aryaduta Palembang, sebagai tempat pelaksanaan kegiatan edukasi dan promotif untuk mendukung gaya hidup sehat.
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


    <!-- LOCATION -->
     <section>
        <div>
            <h2 class="text-3xl font-extrabold text-black-100 text-center mb-5">EVENT LOCATION</h2>
        </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-[70px] items-center"> 
       <div class="flex justify-content-auto gap-[3%] mt-[7%]" data-aos="fade-right" data-aos-duration="1000">
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1893.6431893261731!2d104.74015336954795!3d-2.977309999812416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b75e7e673b969%3A0x83a46f5d2cfc08c1!2sAryaduta%20Palembang!5e1!3m2!1sid!2sid!4v1749048958690!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
       </div>

         <div class="" data-aos="fade-left" data-aos-duration="1000">
                            <h3 class="mb-[23px] font-extrabold text-2xl text-center">
                                <i class="fa-solid fa-location-dot"></i> Hotel Aryaduta Palembang
                            </h3>
                            <table class="w-full text-left border-collapse bg-gray-200">
                                <!-- Rocket Launch Section -->
                                <tr>
                                    <td colspan="4">
                                        <h4 class="text-xl font-semibold text-center mb-[10px]">Waktu Pelaksanaan</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-1"><i class="fa-regular fa-calendar"></i></td>
                                    <td class="px-1 ">Sabtu, 12 Oktober 2024</td>
                                    <td class="px-1"><i class="fa-regular fa-clock"></i></td>
                                    <td class="px-1">16.00 WIB</td>
                                    <td class="px-1"></td>
                                </tr>
                            </table>

         </div>
    </div>


        </section>
    <!-- LOCATION -->

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
                    Himpunan Mahasiswa Sistem Informasi (HIMSI) Fakultas Ilmu Komputer Universitas Sriwijaya (Unsri) telah menjadi wadah pengembangan potensi mahasiswa di bidang teknologi informasi. Melalui berbagai program kerja seperti workshop, seminar, dan kegiatan riset, HIMSI berfokus pada peningkatan kemampuan teknis, soft skills, dan jejaring profesional anggotanya.
                </p>
                <p class="text-black-700 leading-relaxed mt-4">
                   HIMSI Fasilkom Unsri terdiri dari 8 departemen dan 8 divisi, masing-masing memiliki peran strategis dalam mendukung pengembangan potensi anggota. Informasi lengkap mengenai struktur dan kegiatan HIMSI dapat dibaca melalui website resmi <a href="https://himsiunsri.org/" class="underline">HIMSI Unsri</a>.
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