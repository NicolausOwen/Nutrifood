<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hilo Strong Fest Dashboard</title>
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
        .sidebar-icon {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
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
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/LOGO.png') }}" alt="Hilo Logo" class="w-6/12 h-auto">
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 p-6">
                <ul class="space-y-3">
                    <li>
                        <button class="w-full bg-blue-800 rounded-lg px-4 py-3 text-left font-medium hover:bg-blue-700 transition-colors">
                            Tiket Kamu
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg px-4 py-3 text-left font-medium transition-colors">
                            Beli Tiket
                        </button>
                    </li>
                    <li>
                        <button class="w-full text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg px-4 py-3 text-left font-medium transition-colors">
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
                        <h1 class="text-3xl font-bold text-gray-900">Hai, Username</h1>
                        <p class="text-gray-600 mt-1">Selamat Datang di Hilo Strong Fest, Fight Sarcopenia</p>
                    </div>
                    <div class="flex items-center space-x-2">
                                <img src="{{ asset('images/LOGO StrongFest 2025-01 (1).png') }}" alt="Hilo Logo" class="w-40 h-auto">
                    </div>
                </div>
            </header>

            <!-- Main Dashboard Content -->
            <main class="flex-1 p-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Title Section -->
                    <div class="mb-8">
                        <h2 class="text-4xl font-bold text-hilo-green mb-2">Tiket Kamu</h2>
                    </div>

                    <!-- Tickets Table -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-8 py-4 text-left text-sm font-semibold text-gray-900">No.</th>
                                        <th class="px-8 py-4 text-left text-sm font-semibold text-gray-900">Jenis Tiket</th>
                                        <th class="px-8 py-4 text-left text-sm font-semibold text-gray-900">Jumlah Tiket</th>
                                        <th class="px-8 py-4 text-left text-sm font-semibold text-gray-900">Tanggal Pembelian</th>
                                        <th class="px-8 py-4 text-left text-sm font-semibold text-gray-900">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-8 py-6 text-sm text-gray-900">1</td>
                                        <td class="px-8 py-6 text-sm text-gray-900 font-medium">Standard Ticket</td>
                                        <td class="px-8 py-6 text-sm text-gray-900">10</td>
                                        <td class="px-8 py-6 text-sm text-gray-900">1 Januari 2000</td>
                                        <td class="px-8 py-6">
                                            <button class="bg-hilo-green hover:bg-yellow-500 text-hilo-blue font-semibold px-6 py-2 rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                                Lihat Tiket
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-8 py-6 text-sm text-gray-900">2</td>
                                        <td class="px-8 py-6 text-sm text-gray-900 font-medium">Exclusive Ticket</td>
                                        <td class="px-8 py-6 text-sm text-gray-900">15</td>
                                        <td class="px-8 py-6 text-sm text-gray-900">4 Februari 2005</td>
                                        <td class="px-8 py-6">
                                            <button class="bg-hilo-green hover:bg-yellow-500 text-hilo-blue font-semibold px-6 py-2 rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                                Lihat Tiket
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Empty State (if no tickets) -->
                    <!-- Uncomment this section if you want to show empty state
                    <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Tiket</h3>
                        <p class="text-gray-600 mb-6">Anda belum memiliki tiket untuk Hilo Strong Fest</p>
                        <button class="bg-hilo-green hover:bg-yellow-500 text-hilo-blue font-semibold px-8 py-3 rounded-lg transition-colors duration-200">
                            Beli Tiket Sekarang
                        </button>
                    </div>
                    -->
                </div>
            </main>
        </div>
    </div>

    <script>
        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth hover effects
            const buttons = document.querySelectorAll('button');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Table row hover effects
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.01)';
                    this.style.transition = 'transform 0.2s ease';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>
