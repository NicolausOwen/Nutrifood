<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment</title>

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
              cardColor: "#D9D9D9",
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

  <body class="bg-primaryColor">
    <section class="flex flex-col items-center gap-5 py-10 px-4">
      <div class="absolute top-0 right-0 transform rotate-[-30deg]">
        <img
          src="{{ asset('images/excecise 1.png') }}"
          alt="Exercise Figure 1"
          class="w-24 sm:w-36 md:w-48 lg:w-96 opacity-95 left-panel-image-top exercise-image mr-20"
        />
      </div>

      <div
        class="absolute bottom-0 left-0 transform translate-x-0 translate-y-0"
      >
        <img
          src="{{ asset('images/excercise 2.png') }}"
          alt="Exercise Figure 2"
          class="w-44 sm:w-56 md:w-72 opacity-95 left-panel-image-bottom exercise-image"
        />
      </div>
      <!-- Stepper -->
      <div class="mb-12 md:w-[75%] w-[100%]">
        <ol class="relative flex items-center w-full text-secondaryColor">
          <!-- Step 1 -->
          <li class="flex-1 text-center relative">
            <div
              class="flex items-center justify-center w-6 h-6 mx-auto bg-secondaryColor rounded-full z-10"
            ></div>
            <p class="mt-4">Account Info</p>
            <div
              class="absolute top-3 left-1/2 w-full h-[6px] bg-secondaryColor -z-10"
            ></div>
          </li>

          <!-- Step 2 -->
          <li class="flex-1 text-center relative">
            <div
              class="flex items-center justify-center w-6 h-6 mx-auto bg-secondaryColor rounded-full z-10"
            ></div>
            <p class="mt-4">Personal Info</p>
            <div
              class="absolute top-3 left-1/2 w-full h-[6px] bg-secondaryColor -z-10"
            ></div>
          </li>

          <!-- Step 3 -->
          <li class="flex-1 text-center relative">
            <div
              class="flex items-center justify-center w-6 h-6 mx-auto border-4 border-secondaryColor rounded-full z-10 bg-primaryColor"
            ></div>
            <p class="mt-4">Payment</p>
          </li>
        </ol>
      </div>

      <!-- Heading -->
      <h1 class="text-5xl font-black text-secondaryColor mb-8">Payment</h1>

      <!-- Payment Details -->
      <div class="bg-cardColor w-full max-w-2xl p-8 rounded-lg">
        <ul class="font-bold text-lg space-y-2">
          <li>Bank : XXXXXXXX</li>
          <li>No. Rekening : XXXXXXXX</li>
          <li>Nama Penerima : XXXXXXXX</li>
          <li>Nominal Transfer : Rp.XXX</li>
        </ul>
        <p class="mt-4 text-neutral-600">
          *Transfer ke rekening diatas, bukti transfernya di upload di bawah ^_^
        </p>
      </div>

      <form method="POST" action="{{ route('api.payment.createpayment') }}">

        @csrf
        <!-- Upload Bukti Bayar -->
        <div class="relative w-full max-w-2xl mt-6">
            <input
            type="file"
            id="buktiBayar"
            class="hidden"
            name="payment_proof"
            accept="image/*"
            onchange="handleUpload(event)"
            />
            <label
            for="buktiBayar"
            id="uploadLabel"
            class="bg-secondaryColor hover:bg-secondaryColorDark py-4 px-6 block text-center font-bold rounded-lg cursor-pointer transition duration-200 ease-in-out"
            >
            Upload Bukti Bayar
            </label>
        </div>
        <div class="relative items-center w-full max-w-2xl mt-6">
            <button
                type="submit"
                class="bg-secondaryColor hover:bg-secondaryColorDark py-4 px-6 block text-center font-bold rounded-lg cursor-pointer transition duration-200 ease-in-out"
            >
                Submit
            </button>
        </div>
      </form>
    </section>

    <script>
      function handleUpload(event) {
        const label = document.getElementById("uploadLabel");
        const file = event.target.files[0];
        if (file) {
          label.innerHTML = "Berhasil diupload!";
          label.classList.remove(
            "bg-secondaryColor",
            "hover:bg-secondaryColorDark"
          );
          label.classList.add("bg-green-500", "text-white");
        }
      }
    </script>
  </body>
</html>