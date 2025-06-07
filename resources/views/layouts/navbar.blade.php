<!-- Navbar Component - navbar.blade.php -->
<style>
  .underline-hover {
    position: relative;
    display: inline-block;
  }

  .underline-hover::after {
    content: "";
    position: absolute;
    width: 0%;
    height: 2px;
    left: 0;
    bottom: -4px;
    background-color: #bfd101;
    transition: width 0.3s ease;
  }

  .underline-hover:hover::after {
    width: 100%;
  }
</style>

<header class="bg-blue-800">
  <nav class="flex items-center justify-between px-6 md:px-24 lg:px-32 py-5">
    <div>
      <img src="{{ asset('images/LOGO.png') }}" alt="logo" class="w-36 md:w-40" />
    </div>

    <!-- hamburger -->
    <div class="md:hidden">
      <button id="menu-btn" class="text-white text-2xl focus:outline-none">
        <i id="menu-icon" class="fas fa-bars"></i>
      </button>
    </div>

    <ul
      id="menu"
      class="hidden md:flex flex-col md:flex-row gap-4 md:gap-16 text-lg font-semibold text-white absolute md:static top-20 left-0 w-full md:w-auto bg-blue-800 md:bg-transparent px-6 md:px-0 py-6 md:py-0 z-50"
    >
      <li>
        <a
          href="/"
          class="underline-hover hover:text-green-400 transition duration-300 ease-in-out"
          >Home</a
        >
      </li>
      <li>
        <a
          href="/beli-tiket"
          class="underline-hover hover:text-green-400 transition duration-300 ease-in-out"
          >Beli Tiket</a
        >
      </li>
      <li>
        <a
          href="/login"
          class="underline-hover hover:text-green-400 transition duration-300 ease-in-out"
          >Login</a
        >
      </li>
      <li>
        <a
          href="/register"
          class="underline-hover hover:text-green-400 transition duration-300 ease-in-out"
          >Registrasi</a
        >
      </li>
    </ul>
  </nav>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById("menu-btn");
    const menu = document.getElementById("menu");
    const icon = document.getElementById("menu-icon");

    if (btn && menu && icon) {
      btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");

        if (menu.classList.contains("hidden")) {
          icon.classList.remove("fa-times");
          icon.classList.add("fa-bars");
        } else {
          icon.classList.remove("fa-bars");
          icon.classList.add("fa-times");
        }
      });
    }
  });
</script>