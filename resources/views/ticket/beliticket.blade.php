<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiLo - Beli Tiket</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .ticket-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .ticket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: #4285F4;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #3367D6;
            transform: translateY(-2px);
        }

        .status-available {
            background-color: #10B981;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-sold {
            background-color: #EF4444;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header Navigation -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Pilih Tiket</h1>
        </div>

        <!-- Ticket Cards -->
        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Exclusive Ticket -->
            <div class="ticket-card p-6">
                <div class="text-center mb-6">
                    <div class="bg-blue-100 rounded-lg p-4 mb-4">
                        <img src="{{ asset('images/exclusive.png') }}" alt="Exclusive Ticket" class="w-32 h-32 mx-auto object-contain">
                        <div class="text-blue-600 font-semibold mt-2">Exclusive Ticket</div>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Exclusive Ticket</h3>
                    <div class="mb-3">
                        <span id="exclusiveStatus" class="status-available">Available</span>
                    </div>
                    <div class="text-3xl font-bold text-red-500 mb-4">Rp175.000</div>
                </div>

                <div class="text-sm text-gray-600 mb-6 space-y-1">
                    <p class="text-green-600">- Makan Siang</p>
                    <p>- Jersey Strongfest</p>
                    <p>- Hilo Chocofit Protein</p>
                    <p>- Race Pack</p>
                    <p>- Erha Goodie Bag</p>
                    <p>- Kupon Doorprize</p>
                    <p>- Semua Sesi Senam</p>
                    <p>- Medical Checkup</p>
                </div>

                <button onclick="bikinPayment('exclusive')" id="exclusiveBuyBtn" class="bg-gray-400 text-white w-full py-3 rounded-lg font-semibold cursor-not-allowed" disabled>
                    Checking Stock...
                </button>
            </div>

            <!-- Standard Ticket -->
            <div class="ticket-card p-6">
                <div class="text-center mb-6">
                    <div class="bg-blue-100 rounded-lg p-4 mb-4">
                        <img src="{{ asset('images/general.png') }}" alt="General Ticket" class="w-32 h-32 mx-auto object-contain">
                        <div class="text-blue-600 font-semibold mt-2">General Ticket</div>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">General Ticket</h3>
                    <div class="mb-3">
                        <span id="standardStatus" class="status-sold">Sold</span>
                    </div>
                    <div class="text-3xl font-bold text-red-500 mb-4">Rp125.000</div>
                </div>

                <div class="text-sm text-gray-600 mb-6 space-y-1">
                    <p>- Jersey Strongfest</p>
                    <p>- Hilo Chocofit Protein</p>
                    <p>- Race Pack</p>
                    <p>- Erha Goodie Bag</p>
                    <p>- Kupon Doorprize</p>
                    <p>- Semua Sesi Senam</p>
                    <p>- Medical Checkup</p>
                </div>

                <button onclick="bikinPayment('general')" id="standardBuyBtn" class="bg-gray-400 text-white w-full py-3 rounded-lg font-semibold cursor-not-allowed" disabled>
                    Checking Stock...
                </button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('layouts.footer')
    <script>
        const API_BASE_URL = 'https://hilo-sarcopenia.my.id/api';

        async function checkTicketStock(type) {
            try {
                const response = await fetch(`${API_BASE_URL}/tickets/cekstock`, {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ type: type })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error checking stock:', error);
                throw error;
            }
        }

        async function bikinPayment(type) {
            try {
                const button = document.querySelector(`#${type === 'exclusive' ? 'exclusive' : 'standard'}BuyBtn`);
                const originalText = button.textContent;
                button.textContent = 'Processing...';
                button.disabled = true;

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                const response = await fetch(`${API_BASE_URL}/order/bikinorder`, {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken || '',
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        type: type,
                    })
                });

                const data = await response.json();

                if (response.status === 401) {
                    alert('Anda harus login terlebih dahulu!');
                    window.location.href = '/login';
                    return;
                }

                if (!response.ok) {
                    throw new Error(data.message || `HTTP error! status: ${response.status}`);
                }

                if (data.success) {
                    alert('Order berhasil dibuat!');
                    localStorage.setItem('orderid', data.order_id);
                    window.location.href = '/personal-data';
                } else {
                    throw new Error(data.message || 'Failed to create order');
                }

            } catch (error) {
                console.error('Error creating order:', error);
                alert('Terjadi kesalahan saat membuat order: ' + error.message);

                const button = document.querySelector(`#${type === 'exclusive' ? 'exclusive' : 'standard'}BuyBtn`);
                button.textContent = 'Beli Sekarang';
                button.disabled = false;
                button.classList.remove('bg-gray-400', 'cursor-not-allowed');
                button.classList.add('btn-primary');
            }
        }

        function updateTicketStatus(ticketType, stockData) {
            const statusElement = document.querySelector(`#${ticketType}Status`);
            const buyButton = document.querySelector(`#${ticketType}BuyBtn`);

            if (stockData.stock > 0) {
                statusElement.innerHTML = 'Available';
                statusElement.className = 'status-available';

                buyButton.disabled = false;
                buyButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                buyButton.classList.add('btn-primary');
                buyButton.textContent = 'Beli Sekarang';
            } else {
                statusElement.innerHTML = 'Sold';
                statusElement.className = 'status-sold';

                buyButton.disabled = true;
                buyButton.classList.remove('btn-primary');
                buyButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                buyButton.textContent = 'Sold Out';
            }
        }

        function initializeButtons() {
            const exclusiveBtn = document.querySelector('#exclusiveBuyBtn');
            const standardBtn = document.querySelector('#standardBuyBtn');
            const exclusiveStatus = document.querySelector('#exclusiveStatus');
            const standardStatus = document.querySelector('#standardStatus');

            [exclusiveBtn, standardBtn].forEach(btn => {
                if (btn) {
                    btn.disabled = true;
                    btn.classList.remove('btn-primary');
                    btn.classList.add('bg-gray-400', 'cursor-not-allowed');
                    btn.textContent = 'Checking Stock...';
                }
            });

            [exclusiveStatus, standardStatus].forEach(status => {
                if (status) {
                    status.innerHTML = 'Checking...';
                    status.className = 'bg-gray-400 text-white px-3 py-1 rounded-full text-xs font-medium';
                }
            });
        }

        async function checkAllTicketStock() {
            try {
                const exclusiveStock = await checkTicketStock('exclusive');
                updateTicketStatus('exclusive', exclusiveStock);

                const standardStock = await checkTicketStock('general');
                updateTicketStatus('standard', standardStock);

                console.log('Stock updated successfully');
            } catch (error) {
                console.error('Error checking stock:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const ticketCards = document.querySelectorAll('.ticket-card');

            ticketCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            initializeButtons();

            setTimeout(checkAllTicketStock, 1000);
        });

        setInterval(checkAllTicketStock, 30000);
    </script>
</body>
</html>