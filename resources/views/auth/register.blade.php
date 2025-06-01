<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Regist</title>
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

          <div
            class="hilo-yellow rounded-lg p-5 sm:p-6 md:p-8 border-4 border-blue-900 w-full shadow-2xl mb-16 lg:mb-0"
          >
            <h2
              class="text-center text-blue-900 font-bold text-xl sm:text-2xl mb-6"
            >
              Register
            </h2>
            <form method="POST" action="{{ route('register') }}">

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
                  placeholder="Example@email.com"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-bold text-sm"
                />
              </div>

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
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-bold text-sm"
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
                    >
                      <path
                        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                      ></path>
                      <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                  </span>
                </div>
              </div>

              <div class="mb-3">
                <label
                  for="password"
                  class="block text-blue-900 text-sm font-bold mb-1"
                  >Confirm Password</label
                >
                <div class="relative">
                  <input
                    type="password"
                    id="confirm-password"
                    name="password_confirmation"
                    placeholder="re-type your password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-bold text-sm"
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
                  Passwords does not match
                </p>
              </div>

              <!-- Buttons Container -->
              <div
                class="mt-5 sm:mt-6 z-50 flex flex-col sm:flex-row gap-3 sm:gap-4"
              >
                <button
                  type="submit"
                  class="flex-1 bg-[#203e99] text-white py-2 px-3 rounded-lg hover:bg-[#102b6b] transition-all duration-300 font-bold text-sm sm:text-base shadow-md hover:shadow-lg transform hover:-translate-y-0.5 border-2 border-[#102b6b]"
                >
                  Next
                </button>

                <a
                  href="#"
                  class="flex-1 bg-gradient-to-r from-gray-700 to-gray-800 text-white py-2 px-3 rounded-lg hover:from-gray-800 hover:to-gray-900 transition-all duration-300 font-bold text-xs sm:text-sm text-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5 border-2 border-gray-900"
                >
                  Back To Homepage
                </a>
              </div>
            </form>
            <div class="text-center mt-10 font-bold">
              Already Have an Account?
              <a href="/login" class="text-blue-900 text">Login</a>
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
        passwordInput.type =
          passwordInput.type === "password" ? "text" : "password";
      }

      function toggleConfirmPassword() {
        const confirmPasswordInput =
          document.getElementById("confirm-password");
        confirmPasswordInput.type =
          confirmPasswordInput.type === "password" ? "text" : "password";
      }

      // Form validation
      document
        .getElementById("register-form")
        .addEventListener("submit", function (e) {
          const password = document.getElementById("password").value;
          const confirmPassword =
            document.getElementById("confirm-password").value;
          const confirmError = document.getElementById("confirm-error");
          const confirmInput = document.getElementById("confirm-password");

          if (password !== confirmPassword) {
            e.preventDefault();
            confirmError.classList.remove("hidden");
            confirmInput.classList.add("border-red-500");
          } else {
            confirmError.classList.add("hidden");
            confirmInput.classList.remove("border-red-500");
          }
        });
    </script>
  </body>
</html>
