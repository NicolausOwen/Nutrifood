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
                        <a href="{{ route('dashboard') }}" class="w-full bg-blue-800 rounded-lg px-4 py-3 text-left font-medium hover:bg-blue-700 transition-colors block">
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
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Hai, {{ $user->name ?? 'User' }}</h1>
                        <p class="text-gray-600 mt-1">Selamat Datang di Hilo Strong Fest, Fight Sarcopenia</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/LOGO StrongFest 2025-01 (1).png') }}" alt="Strong Fest Logo" class="w-40 h-auto">
                    </div>
                </div>
            </header>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mx-8 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-8 mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Main Dashboard Content -->
            <main class="flex-1 p-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Title Section -->
                    <div class="mb-8">
                        <h2 class="text-4xl font-bold text-hilo-green mb-2">Tiket Kamu</h2>
                        <p class="text-gray-600">Total tiket: {{ $tickets->count() }}</p>
                    </div>

                    @if($ticketGroups->count() > 0)
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
                                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-900">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($ticketGroups as $index => $group)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-8 py-6 text-sm text-gray-900">{{ (int)$index + 1 }}</td>
                                            <td class="px-8 py-6 text-sm text-gray-900 font-medium">
                                                <span class="capitalize">{{ $group['type'] }}</span>
                                            </td>
                                            <td class="px-8 py-6 text-sm text-gray-900">{{ $group['count'] }}</td>
                                            <td class="px-8 py-6 text-sm text-gray-900">
                                                {{ $group['created_at'] ? $group['created_at']->format('d F Y') : '-' }}
                                            </td>
                                            <td class="px-8 py-6 text-sm">
                                                @php
                                                    $usedCount = $group['tickets']->where('is_fully_used', true)->count();
                                                    $totalCount = $group['count'];
                                                @endphp
                                                @if($usedCount == $totalCount)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Semua Terpakai
                                                    </span>
                                                @elseif($usedCount > 0)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        {{ $usedCount }}/{{ $totalCount }} Terpakai
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Belum Terpakai
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-8 py-6">
                                                <button onclick="showTicketDetails('{{ $group['type'] }}', {{ json_encode($group['tickets']) }})"
                                                        class="bg-hilo-green hover:bg-yellow-500 text-hilo-blue font-semibold px-6 py-2 rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
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
                        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Tiket</h3>
                            <p class="text-gray-600 mb-6">Anda belum memiliki tiket untuk Hilo Strong Fest</p>
                            <a href="{{ route('beli-tiket') }}" class="bg-hilo-green hover:bg-yellow-500 text-hilo-blue font-semibold px-8 py-3 rounded-lg transition-colors duration-200 inline-block">
                                Beli Tiket Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- Ticket Details Modal -->
    <div id="ticketModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 max-w-4xl mx-4 max-h-[90vh] overflow-y-auto transform transition-all">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900" id="modalTitle">Detail Tiket</h3>
                <button onclick="hideTicketModal()" class="text-gray-400 hover:text-gray-600">
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
        // Modal functions
        function showTicketDetails(type, tickets) {
            const modal = document.getElementById('ticketModal');
            const title = document.getElementById('modalTitle');
            const content = document.getElementById('modalContent');

            title.textContent = `Detail Tiket ${type.charAt(0).toUpperCase() + type.slice(1)}`;

            let html = '<div class="grid gap-4">';
            tickets.forEach((ticket, index) => {
                const checkupStatus = ticket.checkup ? 'text-green-600' : 'text-gray-400';
                const makanStatus = ticket.makan ? 'text-green-600' : 'text-gray-400';
                const masukStatus = ticket.masuk ? 'text-green-600' : 'text-gray-400';

                html += `
                    <div class="border rounded-lg p-4 bg-gray-50">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="font-semibold text-lg">${ticket.id}</h4>
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
                                <div class="w-8 h-8 rounded-full mx-auto mb-1 flex items-center justify-center ${ticket.checkup ? 'bg-green-100' : 'bg-gray-100'}">
                                    <svg class="w-4 h-4 ${checkupStatus}" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <p class="${checkupStatus}">Check-up</p>
                            </div>
                            <div class="text-center">
                                <div class="w-8 h-8 rounded-full mx-auto mb-1 flex items-center justify-center ${ticket.makan ? 'bg-green-100' : 'bg-gray-100'}">
                                    <svg class="w-4 h-4 ${makanStatus}" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <p class="${makanStatus}">Makan</p>
                            </div>
                            <div class="text-center">
                                <div class="w-8 h-8 rounded-full mx-auto mb-1 flex items-center justify-center ${ticket.masuk ? 'bg-green-100' : 'bg-gray-100'}">
                                    <svg class="w-4 h-4 ${masukStatus}" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <p class="${masukStatus}">Masuk</p>
                            </div>
                        </div>
                    </div>
                `;
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