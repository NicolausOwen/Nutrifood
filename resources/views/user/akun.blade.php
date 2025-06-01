<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account & Settings - Hilo Strong Fest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'hilo-blue': '#1a3a8f',
                        'hilo-green': '#ccdb00',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .form-input {
            transition: all 0.3s ease;
        }
        .form-input:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(26, 58, 143, 0.15);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-80 bg-hilo-blue text-white flex flex-col relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute bottom-0 left-0 w-full h-64 opacity-10">
                <svg viewBox="0 0 400 300" class="w-full h-full">
                    <!-- Dumbbell illustration -->
                    <g stroke="currentColor" stroke-width="3" fill="none">
                        <circle cx="80" cy="180" r="25"/>
                        <circle cx="180" cy="180" r="25"/>
                        <line x1="105" y1="180" x2="155" y2="180" stroke-width="8"/>
                        <circle cx="280" cy="120" r="20"/>
                        <circle cx="360" cy="120" r="20"/>
                        <line x1="300" y1="120" x2="340" y2="120" stroke-width="6"/>
                    </g>
                </svg>
            </div>

            <!-- Header with Logo -->
            <div class="p-6 border-b border-blue-800">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center space-x-2">
                        <div class="bg-hilo-green rounded-full px-3 py-1">
                            <span class="text-hilo-blue font-bold text-sm">HiLo</span>
                        </div>
                        <div class="bg-gray-800 rounded-full p-2">
                            <span class="text-white text-xs font-bold">ST</span>
                        </div>
                    </div>
                </div>
                <p class="text-blue-200 text-sm mt-2">HIMSI</p>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 p-6">
                <ul class="space-y-3">
                    <li>
                        <button class="w-full text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg px-4 py-3 text-left font-medium transition-colors">
                            Tiket Kamu
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg px-4 py-3 text-left font-medium transition-colors">
                            Beli Tiket
                        </button>
                    </li>
                    <li>
                        <button class="w-full bg-blue-800 rounded-lg px-4 py-3 text-left font-medium hover:bg-blue-700 transition-colors">
                            Akun
                        </button>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Account & Settings</h1>
                        <p class="text-gray-600 mt-1">Selamat Datang di Hilo Strong Fest, Fight Sarcopenia</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="bg-hilo-green rounded-lg px-4 py-2">
                            <span class="text-hilo-blue font-bold text-sm">HiLo</span>
                        </div>
                        <div class="bg-hilo-blue text-white rounded-lg px-3 py-2 text-sm font-bold">
                            STRONG FEST
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 p-8">
                <div class="max-w-4xl mx-auto space-y-8">

                    <!-- Profile Information Section -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Informasi Profil</h2>
                            <p class="text-gray-600">Update informasi profil dan alamat e-mail</p>
                        </div>

                        <form class="space-y-6">
                            <div>
                                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
                                <input
                                    type="text"
                                    id="nama"
                                    name="nama"
                                    class="form-input w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-hilo-blue focus:border-transparent"
                                    placeholder="Masukkan nama lengkap"
                                >
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">E-mail</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-input w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-hilo-blue focus:border-transparent"
                                    placeholder="Masukkan alamat email"
                                >
                            </div>

                            <div class="pt-4">
                                <button
                                    type="submit"
                                    class="bg-hilo-green hover:bg-yellow-500 text-hilo-blue font-bold px-8 py-3 rounded-lg transition-all duration-200 hover:shadow-lg hover:scale-105"
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Update Password Section -->
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Update Password</h2>
                            <p class="text-gray-600">Pastikan password mu aman dan kuat</p>
                        </div>

                        <form class="space-y-6">
                            <div>
                                <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Password Sekarang</label>
                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    class="form-input w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-hilo-blue focus:border-transparent"
                                    placeholder="Masukkan password saat ini"
                                >
                            </div>

                            <div>
                                <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                <input
                                    type="password"
                                    id="new_password"
                                    name="new_password"
                                    class="form-input w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-hilo-blue focus:border-transparent"
                                    placeholder="Masukkan password baru"
                                >
                            </div>

                            <div>
                                <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                                <input
                                    type="password"
                                    id="confirm_password"
                                    name="confirm_password"
                                    class="form-input w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-hilo-blue focus:border-transparent"
                                    placeholder="Konfirmasi password baru"
                                >
                            </div>

                            <div class="pt-4">
                                <button
                                    type="submit"
                                    class="bg-hilo-green hover:bg-yellow-500 text-hilo-blue font-bold px-8 py-3 rounded-lg transition-all duration-200 hover:shadow-lg hover:scale-105"
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Delete Account Section -->
                    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-red-500">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Hapus Akun</h2>
                            <p class="text-gray-600 leading-relaxed">
                                Setelah akun Anda dihapus, semua data dan sumber daya akan hilang secara permanen.
                                Sebelum menghapus akun, pastikan untuk mengunduh data yang ingin disimpan
                            </p>
                        </div>

                        <button
                            type="button"
                            onclick="showDeleteModal()"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-3 rounded-lg transition-all duration-200 hover:shadow-lg hover:scale-105"
                        >
                            HAPUS AKUN
                        </button>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 max-w-md mx-4 transform transition-all">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Hapus Akun</h3>
                <p class="text-gray-600 mb-6">
                    Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.
                </p>
                <div class="flex space-x-3">
                    <button
                        onclick="hideDeleteModal()"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg transition-colors"
                    >
                        Batal
                    </button>
                    <button
                        onclick="confirmDelete()"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg transition-colors"
                    >
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal functions
        function showDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function hideDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function confirmDelete() {
            // Here you would typically send a request to delete the account
            alert('Akun akan dihapus (implementasi backend diperlukan)');
            hideDeleteModal();
        }

        // Form validation and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add form validation
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Basic validation
                    const inputs = form.querySelectorAll('input[required]');
                    let isValid = true;

                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            isValid = false;
                            input.classList.add('border-red-500');
                        } else {
                            input.classList.remove('border-red-500');
                        }
                    });

                    if (isValid) {
                        // Show success message
                        const button = form.querySelector('button[type="submit"]');
                        const originalText = button.textContent;
                        button.textContent = 'Tersimpan!';
                        button.classList.add('bg-green-500');

                        setTimeout(() => {
                            button.textContent = originalText;
                            button.classList.remove('bg-green-500');
                        }, 2000);
                    }
                });
            });

            // Password confirmation validation
            const newPassword = document.getElementById('new_password');
            const confirmPassword = document.getElementById('confirm_password');

            if (newPassword && confirmPassword) {
                confirmPassword.addEventListener('input', function() {
                    if (newPassword.value !== confirmPassword.value) {
                        confirmPassword.classList.add('border-red-500');
                    } else {
                        confirmPassword.classList.remove('border-red-500');
                    }
                });
            }

            // Close modal when clicking outside
            document.getElementById('deleteModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideDeleteModal();
                }
            });
        });
    </script>
</body>
</html>
