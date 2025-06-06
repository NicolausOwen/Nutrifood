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
                        <a href="{{ route('dashboard') }}" class="w-full text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg px-4 py-3 text-left font-medium transition-colors block">
                            Order Kamu
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard2') }}" class="w-full bg-blue-800 rounded-lg px-4 py-3 text-left font-medium hover:bg-blue-700 transition-colors block">
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
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-hilo-green mb-2">Tiket Kamu</h2>
                        <p class="text-gray-600 text-sm sm:text-base">Total tiket: {{ $tickets->count() }}</p>
                    </div>

                    @if($ticketGroups->count() > 0)
                        <!-- Tickets Table -->
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
                                            <th class="px-4 sm:px-6 lg:px-8 py-3 text-left text-xs sm:text-sm font-semibold text-gray-900">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($ticketGroups as $index => $group)
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
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Active
                                                </span>
                                            </td>
                                            <td class="px-4 sm:px-6 lg:px-8 py-4">
                                                <button onclick="showTicketDetails('{{ $group['type'] }}', {{ json_encode($group['tickets']) }})"
                                                        class="bg-hilo-green hover:bg-yellow-500 text-hilo-blue font-semibold px-3 py-1.5 sm:px-6 sm:py-2 rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md text-xs sm:text-sm">
                                                    Lihat Tiket
                                                </button>
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
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">Belum Ada Tiket</h3>
                            <p class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base">Anda belum memiliki tiket untuk Hilo Strong Fest</p>
                            <a href="{{ route('beli-tiket') }}" class="bg-hilo-green hover:bg-yellow-500 text-hilo-blue font-semibold px-6 py-2 sm:px-8 sm:py-3 rounded-lg transition-colors duration-200 inline-block text-sm sm:text-base">
                                Beli Tiket Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- Ticket Details Modal -->
    <div id="ticketModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl p-4 sm:p-6 lg:p-8 max-w-4xl w-full max-h-[90vh] overflow-y-auto transform transition-all">
            <div class="flex justify-between items-center mb-4 sm:mb-6">
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900" id="modalTitle">Detail Tiket</h3>
                <button onclick="hideTicketModal()" class="text-gray-400 hover:text-gray-600 p-2 sm:p-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent" class="space-y-4">
                <!-- Dynamic content will be inserted here -->
            </div>
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

            // Hover effects
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

            // Close modal when clicking outside
            document.getElementById('ticketModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideTicketModal();
                }
            });
        });
        
        // Modal functions
        function showTicketDetails(type, tickets) {
            const modal = document.getElementById('ticketModal');
            const title = document.getElementById('modalTitle');
            const content = document.getElementById('modalContent');

            title.textContent = `Detail Tiket ${type.charAt(0).toUpperCase() + type.slice(1)}`;

            let html = '<div class="grid gap-4">';
            tickets.forEach((ticket, index) => {
                // Proper boolean conversion - handle both boolean and string values
                const checkupUsed = ticket.checkup === true || ticket.checkup === 1 || ticket.checkup === '1';
                const makanUsed = ticket.makan === true || ticket.makan === 1 || ticket.makan === '1';
                const masukUsed = ticket.masuk === true || ticket.masuk === 1 || ticket.masuk === '1';

                // Set colors based on actual boolean status
                const checkupStatus = checkupUsed ? 'text-green-600' : 'text-gray-400';
                const makanStatus = makanUsed ? 'text-green-600' : 'text-gray-400';
                const masukStatus = masukUsed ? 'text-green-600' : 'text-gray-400';

                // Set background colors
                const checkupBg = checkupUsed ? 'bg-green-100' : 'bg-gray-100';
                const makanBg = makanUsed ? 'bg-green-100' : 'bg-gray-100';
                const masukBg = masukUsed ? 'bg-green-100' : 'bg-gray-100';

                if (type == 'exclusive') {
                    html += `
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="font-semibold text-lg">${ticket.id}</h4>
                                    <p class="font-normal text-gray-600">Nama: ${ticket.name}</p>
                                    <p class="text-sm text-gray-600">QR Code:
                                        <div style="text-align: center; margin: 30px 0;">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=${ticket.qr_code}" alt="QR Code" style="border-radius: 8px;">
                                        </div>
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">Pembelian:</p>
                                    <p class="text-sm font-medium">${ticket.purchase_date ? new Date(ticket.purchase_date).toLocaleDateString('id-ID') : '-'}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 text-sm">
                                <div class="text-center">
                                    <div class="w-8 h-8 rounded-full mx-auto mb-1 flex items-center justify-center ${masukBg}">
                                        ${masukUsed ?
                                            '<svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>'
                                            : '<svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'
                                        }
                                    </div>
                                    <p class="${masukStatus}">Check In</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-8 h-8 rounded-full mx-auto mb-1 flex items-center justify-center ${checkupBg}">
                                        ${checkupUsed ?
                                            '<svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>'
                                            : '<svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'
                                        }
                                    </div>
                                    <p class="${checkupStatus}">Race-Pack</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-8 h-8 rounded-full mx-auto mb-1 flex items-center justify-center ${makanBg}">
                                        ${makanUsed ?
                                            '<svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>'
                                            : '<svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'
                                        }
                                    </div>
                                    <p class="${makanStatus}">Makan</p>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    html += `
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="font-semibold text-lg">${ticket.id}</h4>
                                    <p class="font-normal text-gray-600">Nama: ${ticket.name}</p>
                                    <p class="text-sm text-gray-600">QR Code:
                                        <div style="text-align: center; margin: 30px 0;">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=${ticket.qr_code}" alt="QR Code" style="border-radius: 8px;">
                                        </div>
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">Pembelian:</p>
                                    <p class="text-sm font-medium">${ticket.purchase_date ? new Date(ticket.purchase_date).toLocaleDateString('id-ID') : '-'}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 text-sm">
                                <div class="text-center">
                                    <div class="w-8 h-8 rounded-full mx-auto mb-1 flex items-center justify-center ${masukBg}">
                                        ${masukUsed ?
                                            '<svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>'
                                            : '<svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'
                                        }
                                    </div>
                                    <p class="${masukStatus}">Check In</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-8 h-8 rounded-full mx-auto mb-1 flex items-center justify-center ${checkupBg}">
                                        ${checkupUsed ?
                                            '<svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>'
                                            : '<svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'
                                        }
                                    </div>
                                    <p class="${checkupStatus}">Race-Pack</p>
                                </div>
                            </div>
                        </div>
                    `;
                }
            });
            html += '</div>';

            content.innerHTML = html;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function hideTicketModal() {
            const modal = document.getElementById('ticketModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

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

            // Close modal when clicking outside
            document.getElementById('ticketModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideTicketModal();
                }
            });
        });
    </script>
</body>
</html>