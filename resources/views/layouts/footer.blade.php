
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>footer</title>

    <!-- Fonts & Icons -->
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
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

    <style>
      body {
        font-family: "Montserrat", sans-serif;
      }
    </style>
  </head>
  <body>
    <footer class="mt-20">
      <section
        class="lg:px-32 md:px-20 px-8 flex flex-col md:flex-row gap-16 md:gap-0 justify-between"
      >
        <div>
          <img src="{{ asset('images/LOGO.png') }}" alt="" class="w-36" />
          <div class="mt-6">
            <p>Ballroom Hotel Aryaduta</p>
            <p>Jl. POM IX, Kota Palembang, Sumatera Selatan 30137</p>
          </div>
        </div>
        <div>
          <p class="text-xl font-black">Contact Us</p>
          <div class="mt-4">
            <p>nutrihub.palembang@gmail.com</p>
            <div class="text-xl flex gap-4 mt-1">
              <a
                href=""
                class="hover:text-secondaryColor transition delay-50 ease-in-out"
                ><i class="fa-brands fa-instagram"></i
              ></a>
              <a
                href=""
                class="hover:text-secondaryColor transition delay-50 ease-in-out"
                ><i class="fa-brands fa-facebook-f"></i
              ></a>
              <a
                href=""
                class="hover:text-secondaryColor transition delay-50 ease-in-out"
                ><i class="fa-brands fa-youtube"></i
              ></a>
            </div>
          </div>
        </div>
        <div>
          <p class="text-xl font-black">Links</p>
          <div class="mt-4">
            <ul class="flex flex-col gap-1">
              <a
                href="/"
                class="hover:text-secondaryColor transition delay-50 ease-in-out"
              >
                <li>Home</li>
              </a>
              <a
                href="/beli-tiket"
                class="hover:text-secondaryColor transition delay-50 ease-in-out"
              >
                <li>Beli Tiket</li>
              </a>
              <a
                href="/register"
                class="hover:text-secondaryColor transition delay-50 ease-in-out"
              >
                <li>Registrasi</li>
              </a>
              <a
                href="/login"
                class="hover:text-secondaryColor transition delay-50 ease-in-out"
              >
                <li>Login</li>
              </a>
            </ul>
          </div>
        </div>
      </section>

      <div
        class="mt-16 border-t border-neutral-500 pt-8 lg:mx-24 md:mx-16 mx-6 mb-8"
      >
        <p class="text-center text-sm text-neutral-500">
          &copy; 2025 Nutrihub & HIMSI Fasilkom Unsri. All Rights Reserved.
        </p>
      </div>
    </footer>
  </body>
</html>