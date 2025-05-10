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
      .loading-spinner {
        display: none;
        animation: spin 1s linear infinite;
      }
      @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
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

      <!-- Status Messages -->
      <div id="statusMessages" class="w-full max-w-2xl mt-4">
        <div id="errorAlert" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
          <span id="errorMessage" class="block sm:inline"></span>
        </div>
        <div id="successAlert" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
          <span id="successMessage" class="block sm:inline"></span>
        </div>
      </div>

      <!-- Payment Form -->
      <form
        id="paymentForm"
        class="w-full max-w-2xl"
        enctype="multipart/form-data"
      >
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <!-- Preview Image -->
        <div id="previewContainer" class="hidden w-full max-w-2xl mt-6 flex justify-center">
          <img id="imagePreview" src="#" alt="Preview" class="max-w-full max-h-64 rounded-lg shadow-lg" />
        </div>

        <!-- Upload Bukti Bayar -->
        <div class="relative w-full max-w-2xl mt-6">
          <input
            type="file"
            id="buktiBayar"
            class="hidden"
            name="payment_proof"
            accept="image/jpeg,image/jpg,image/png"
            onchange="handleUpload(event)"
          />
          <label
            for="buktiBayar"
            id="uploadLabel"
            class="bg-secondaryColor hover:bg-secondaryColorDark py-4 px-6 block text-center font-bold rounded-lg cursor-pointer transition duration-200 ease-in-out"
          >
            Upload Bukti Bayar
          </label>
          <p id="fileNameDisplay" class="mt-2 text-white text-center hidden"></p>
        </div>

        <!-- Submit Button -->
        <div class="relative w-full max-w-2xl mt-6">
          <button
            type="button"
            id="submitButton"
            onclick="submitPayment()"
            class="w-full bg-secondaryColor hover:bg-secondaryColorDark py-4 px-6 block text-center font-bold rounded-lg cursor-pointer transition duration-200 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed"
            disabled
          >
            <i id="loadingSpinner" class="fa fa-spinner loading-spinner mr-2"></i>
            Submit Pembayaran
          </button>
        </div>
      </form>
    </section>

    <script>
      // Preview uploaded image
      function handleUpload(event) {
        const file = event.target.files[0];
        const label = document.getElementById("uploadLabel");
        const submitButton = document.getElementById("submitButton");
        const fileNameDisplay = document.getElementById("fileNameDisplay");
        const previewContainer = document.getElementById("previewContainer");
        const imagePreview = document.getElementById("imagePreview");

        if (file) {
          // Check file type
          if (!['image/jpeg', 'image/jpg', 'image/png'].includes(file.type)) {
            showError("File harus berupa gambar (JPG, JPEG, atau PNG)");
            return;
          }

          // Check file size (max 2MB)
          if (file.size > 2 * 1024 * 1024) {
            showError("Ukuran file tidak boleh melebihi 2MB");
            return;
          }

          // Update upload button appearance
          label.innerHTML = "File Dipilih";
          label.classList.remove("bg-secondaryColor", "hover:bg-secondaryColorDark");
          label.classList.add("bg-green-500", "text-white");

          // Display file name
          fileNameDisplay.textContent = file.name;
          fileNameDisplay.classList.remove("hidden");

          // Enable submit button
          submitButton.disabled = false;

          // Show image preview
          const reader = new FileReader();
          reader.onload = function(e) {
            imagePreview.src = e.target.result;
            previewContainer.classList.remove("hidden");
          }
          reader.readAsDataURL(file);

          // Hide any previous errors
          hideError();
        }
      }

      // Submit payment form via AJAX
      function submitPayment() {
        const form = document.getElementById("paymentForm");
        const formData = new FormData(form);
        const submitButton = document.getElementById("submitButton");
        const loadingSpinner = document.getElementById("loadingSpinner");

        // Show loading state
        submitButton.disabled = true;
        loadingSpinner.style.display = "inline-block";
        submitButton.textContent = " Sedang Memproses...";
        submitButton.prepend(loadingSpinner);

        // Get CSRF token
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch("{{ route('api.payment.createpayment') }}", {
          method: "POST",
          body: formData,
          headers: {
            'X-CSRF-TOKEN': token
          },
          credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
          loadingSpinner.style.display = "none";

          if (data.status === 'success') {
            showSuccess(data.message);
            // Redirect after successful payment (optional)
            // window.location.href = '/payment/success';
          } else {
            showError(data.message || "Terjadi kesalahan saat mengunggah bukti pembayaran");
            submitButton.disabled = false;
            submitButton.textContent = "Submit Pembayaran";
          }
        })
        .catch(error => {
          console.error("Error:", error);
          showError("Terjadi kesalahan saat menghubungi server");
          loadingSpinner.style.display = "none";
          submitButton.disabled = false;
          submitButton.textContent = "Submit Pembayaran";
        });
      }

      // Show error message
      function showError(message) {
        const errorAlert = document.getElementById("errorAlert");
        const errorMessage = document.getElementById("errorMessage");

        errorMessage.textContent = message;
        errorAlert.classList.remove("hidden");
        successAlert.classList.add("hidden");

        // Scroll to error message
        errorAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }

      // Hide error message
      function hideError() {
        const errorAlert = document.getElementById("errorAlert");
        errorAlert.classList.add("hidden");
      }

      // Show success message
      function showSuccess(message) {
        const successAlert = document.getElementById("successAlert");
        const successMessage = document.getElementById("successMessage");
        const errorAlert = document.getElementById("errorAlert");

        successMessage.textContent = message;
        successAlert.classList.remove("hidden");
        errorAlert.classList.add("hidden");

        // Reset form
        document.getElementById("paymentForm").reset();
        document.getElementById("uploadLabel").innerHTML = "Upload Bukti Bayar";
        document.getElementById("uploadLabel").classList.remove("bg-green-500", "text-white");
        document.getElementById("uploadLabel").classList.add("bg-secondaryColor", "hover:bg-secondaryColorDark");
        document.getElementById("fileNameDisplay").classList.add("hidden");
        document.getElementById("previewContainer").classList.add("hidden");
        document.getElementById("submitButton").disabled = true;
        document.getElementById("submitButton").textContent = "Submit Pembayaran";

        // Scroll to success message
        successAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    </script>
  </body>
</html>