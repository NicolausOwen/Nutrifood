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
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        .sidebar-icon {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        }

        /* Fixed Mobile Sidebar Styles */
        @media (max-width: 1024px) {
            .sidebar {
                position: fixed !important;
                top: 0;
                left: 0;
                bottom: 0;
                width: 280px !important;
                min-width: 280px !important;
                max-width: 280px !important;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 50;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0,0,0,0.5);
                z-index: 40;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }
            .sidebar-overlay.active {
                opacity: 1;
                visibility: visible;
            }
            .sidebar-toggle {
                display: block;
            }
            .main-content {
                margin-left: 0 !important;
            }
        }

        @media (min-width: 1025px) {
            .sidebar {
                position: relative;
                transform: translateX(0);
                width: 320px !important;
            }
            .sidebar-toggle {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Mobile Sidebar Toggle -->
    <button class="sidebar-toggle fixed top-4 left-4 z-50 bg-hilo-blue text-white p-3 rounded-lg shadow-lg lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay"></div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-80 bg-hilo-blue text-white flex flex-col relative overflow-hidden" style="flex-shrink: 0;">
            <!-- Close Button -->
            <button class="sidebar-close absolute top-4 right-4 text-white lg:hidden p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Background Pattern -->
            <div class="absolute bottom-0 left-0 w-full h-64 opacity-10">
                <svg viewBox="0 0 400 300" class="w-full h-full">
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
                        <a href="{{ route('dashboard') }}" class="w-full bg-blue-800 rounded-lg px-4 py-3 text-left font-medium hover:bg-blue-700 transition-colors block">
                            Order Kamu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard2') }}" class="w-full text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg px-4 py-3 text-left font-medium transition-colors block">
                            Tiket Kamu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('beli-tiket') }}" class="w-full text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg px-4 py-3 text-left font-medium transition-colors block">
                            Beli Tiket
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="w-full text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg px-4 py-3 text-left font-medium transition-colors block">
                            Akun
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg px-4 py-3 text-left font-medium transition-colors">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Hai StrongFest</h1>
                        <p class="text-gray-600 mt-1 text-sm sm:text-base">Selamat Datang di Hilo Strong Fest, Fight Sarcopenia</p>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('images/LOGO StrongFest 2025-01 (1).png') }}" alt="Strong Fest Logo" class="w-32 sm:w-40 h-auto">
                    </div>
                </div>
            </header>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mx-4 sm:mx-8 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-4 sm:mx-8 mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Main Dashboard Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Title Section -->
                    <div class="mb-6 sm:mb-8">
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-hilo-green mb-2">Order Kamu</h2>
                        <p class="text-gray-600 text-sm sm:text-base">Total Order: {{ $orders->count() }}</p>
                    </div>

                    @if($orderGroups->count() > 0)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50 border-b border-gray-200">
                                        <tr>
                                            <th class="px-4 sm:px-6 lg:px-8 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">No.</th>
                                            <th class="px-4 sm:px-6 lg:px-8 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">Jenis Tiket</th>
                                            <th class="px-4 sm:px-6 lg:px-8 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">Jumlah Tiket</th>
                                            <th class="px-4 sm:px-6 lg:px-8 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">Tanggal Pembelian</th>
                                            <th class="px-4 sm:px-6 lg:px-8 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($orderGroups as $index => $group)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-4 sm:px-6 lg:px-8 py-4 text-xs sm:text-sm text-gray-900">{{ (int)$index + 1 }}</td>
                                            <td class="px-4 sm:px-6 lg:px-8 py-4 text-xs sm:text-sm text-gray-900 font-medium">
                                                <span class="capitalize">{{ $group['type'] }}</span>
                                            </td>
                                            <td class="px-4 sm:px-6 lg:px-8 py-4 text-xs sm:text-sm text-gray-900">{{ $group['count'] }}</td>
                                            <td class="px-4 sm:px-6 lg:px-8 py-4 text-xs sm:text-sm text-gray-900">
                                                {{ $group['purchase_date'] ? $group['purchase_date'] : '-' }}
                                            </td>
                                            <td class="px-4 sm:px-6 lg:px-8 py-4 text-xs sm:text-sm">
                                                @php
                                                    $usedCount = $group['orders']->where('is_fully_used', true)->count();
                                                    $totalCount = $group['count'];
                                                @endphp
                                                @if($group['status'] == 'Active')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-400 text-blue-800">
                                                        Pending
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 md:p-12 text-center">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Belum Ada Order</h3>
                            <p class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base">Anda belum memiliki order tiket untuk Hilo Strong Fest</p>
                            <a href="{{ route('beli-tiket') }}" class="bg-hilo-green hover:bg-yellow-500 text-hilo-blue font-semibold px-6 py-2 sm:px-8 sm:py-3 rounded-lg transition-colors duration-200 inline-block text-sm sm:text-base">
                                Beli Tiket Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script>
        // Fixed Mobile sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const sidebarClose = document.querySelector('.sidebar-close');
            const overlay = document.querySelector('.sidebar-overlay');

            // Toggle sidebar function
            function toggleSidebar() {
                if (sidebar && overlay) {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');

                    // Prevent body scroll when sidebar is open
                    if (sidebar.classList.contains('active')) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = '';
                    }
                }
            }

            // Event listeners
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            if (sidebarClose) {
                sidebarClose.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            // Close sidebar when clicking on nav links (mobile only)
            const sidebarLinks = document.querySelectorAll('.sidebar nav a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024 && sidebar.classList.contains('active')) {
                        toggleSidebar();
                    }
                });
            });

            // Close sidebar on window resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024 && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });

            // Handle escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                    toggleSidebar();
                }
            });

            // Original interactive elements
            const buttons = document.querySelectorAll('button');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Table row hover effects - only on non-touch devices
            if (!('ontouchstart' in window || navigator.maxTouchPoints)) {
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
            }
        });
    </script>
</body>
</html>