<x-filament::page>
    <div class="space-y-6 max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-primary-600 dark:text-primary-400 mb-6">Tiket Scanner</h1>
        </div>

        <!-- Main Scanner Card -->
        <x-filament::card>
            <div class="p-6">
                <!-- Scanner Area -->
                <div class="relative mb-6">
                    <div id="reader"
                        class="w-80 h-80 mx-auto border-2 border-primary-500 rounded-xl shadow-lg overflow-hidden transition-all duration-300"
                        style="display: none;">
                    </div>

                    <!-- Scanner Placeholder -->
                    <div id="scanner-placeholder"
                        class="w-80 h-80 mx-auto border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 dark:bg-gray-800 dark:border-gray-600 flex items-center justify-center transition-all duration-300">
                        <div class="text-center">
                            <div class="w-16 h-16 mx-auto mb-4 text-gray-400">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9.5 6.5v3h-3v-3h3M11 5H5v6h6V5zm-1.5 9.5v3h-3v-3h3M11 13H5v6h6v-6zm6.5-6.5v3h-3v-3h3M19 5h-6v6h6V5zm-6.5 9.5v3h-3v-3h3M19 13h-6v6h6v-6zM6 7h1.5v1.5H6zm0 9h1.5v1.5H6zm9-9H16.5v1.5H15zm0 9H16.5v1.5H15z"/>
                                </svg>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 text-lg">Tekan tombol untuk mulai memindai</p>
                        </div>
                    </div>

                    <!-- Success Animation Overlay -->
                    <div id="success-overlay"
                        class="absolute inset-0 bg-primary-500 bg-opacity-95 rounded-xl flex items-center justify-center transition-all duration-500 transform scale-0 opacity-0">
                        <div class="text-center text-primary">
                            <div class="w-20 h-20 mx-auto mb-4 animate-bounce">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                </svg>
                            </div>
                            <p class="text-2xl font-bold">Berhasil!</p>
                        </div>
                    </div>

                    <!-- Loading Overlay -->
                    <div id="loading-overlay"
                        class="absolute inset-0 bg-blue-600 bg-opacity-95 rounded-xl flex items-center justify-center transition-all duration-300 transform scale-0 opacity-0 z-10">
                        <div class="text-center text-white">
                            <div class="relative mb-4">
                                <div class="animate-spin rounded-full h-16 w-16 border-4 border-blue-200 border-t-white"></div>
                                <div class="absolute inset-0 rounded-full border-4 border-blue-100 animate-pulse"></div>
                            </div>
                            <p class="text-xl font-bold mb-2">Memvalidasi tiket...</p>
                            <p class="text-blue-100 animate-pulse">Harap tunggu sebentar</p>
                            <div class="mt-4 flex justify-center space-x-1">
                                <div class="w-2 h-2 bg-white rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                                <div class="w-2 h-2 bg-white rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                                <div class="w-2 h-2 bg-white rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Result Popup Overlay -->
                    <div id="result-overlay"
                        class="absolute inset-0 bg-black bg-opacity-90 rounded-xl flex items-center justify-center transition-all duration-300 transform scale-0 opacity-0 z-20">
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 max-w-sm w-full mx-4 max-h-full overflow-y-auto">
                            <div id="result-content">
                                <!-- Result content will be inserted here -->
                            </div>
                            <div class="flex gap-3 mt-6">
                                <button id="scan-again-btn"
                                    class="flex-1 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors font-semibold">
                                    🔄 Scan Lagi
                                </button>
                                <button id="close-result-btn"
                                    class="flex-1 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors font-semibold">
                                    ✖️ Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scanner Controls -->
                <div class="flex flex-wrap justify-center gap-3 mb-6">
                    <button id="start-button"
                        class="fi-btn fi-btn-size-lg relative grid-flow-col items-center justify-center font-semibold transition-all duration-200 focus:outline-none disabled:opacity-50 rounded-xl gap-2 px-6 py-3 text-base bg-primary-600 hover:bg-primary-700 hover:scale-105 text-white shadow-lg">
                        <span class="fi-btn-label">🎯 Mulai Pemindaian</span>
                    </button>
                    <button id="stop-button" disabled
                        class="fi-btn fi-btn-size-lg relative grid-flow-col items-center justify-center font-semibold transition-all duration-200 focus:outline-none disabled:opacity-50 rounded-xl gap-2 px-6 py-3 text-base bg-gray-500 text-white cursor-not-allowed shadow-lg">
                        <span class="fi-btn-label">⏹️ Hentikan</span>
                    </button>
                    <button id="switch-camera"
                        class="fi-btn fi-btn-size-lg relative grid-flow-col items-center justify-center font-semibold transition-all duration-200 focus:outline-none disabled:opacity-50 rounded-xl gap-2 px-6 py-3 text-base bg-gray-600 hover:bg-gray-700 hover:scale-105 text-white shadow-lg">
                        <span class="fi-btn-label">🔄 Ganti Kamera</span>
                    </button>
                </div>

                <!-- Validation Target -->
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-center text-gray-900 dark:text-white mb-4">Pilih Target Validasi</h3>
                    <div class="flex flex-wrap justify-center gap-3">
                        <button id="validate-masuk"
                            class="validate-btn transition-all duration-200 hover:scale-105 relative overflow-hidden rounded-xl px-6 py-4 text-base font-semibold text-white bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 shadow-lg">
                            <span class="relative z-10">🚪 Check In</span>
                        </button>
                        <button id="validate-checkup"
                            class="validate-btn transition-all duration-200 hover:scale-105 relative overflow-hidden rounded-xl px-6 py-4 text-base font-semibold text-white bg-gradient-to-r from-success-500 to-success-600 hover:from-success-600 hover:to-success-700 shadow-lg ring-4 ring-success-300">
                            <span class="relative z-10">🏃‍♂️ Race Pack</span>
                        </button>
                        <button id="validate-makan"
                            class="validate-btn transition-all duration-200 hover:scale-105 relative overflow-hidden rounded-xl px-6 py-4 text-base font-semibold text-white bg-gradient-to-r from-warning-500 to-warning-600 hover:from-warning-600 hover:to-warning-700 shadow-lg">
                            <span class="relative z-10">🍽️ Makan</span>
                        </button>
                    </div>
                    <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-3">
                        Target aktif: <span id="active-target" class="font-bold text-primary-600 dark:text-primary-400 text-lg">Race Pack</span>
                    </p>
                </div>
            </div>
        </x-filament::card>

        <!-- Scan History (Collapsible) -->
        <x-filament::card>
            <div class="p-4">
                <button id="history-toggle"
                    class="w-full flex items-center justify-between p-3 text-left hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">📝 Riwayat Pemindaian</h3>
                    <svg id="history-arrow" class="w-5 h-5 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div id="history-content" class="hidden">
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mt-3">
                        <ul id="history-list" class="space-y-2 max-h-64 overflow-y-auto">
                            <li class="p-3 text-gray-600 dark:text-gray-400 text-center">Belum ada riwayat pemindaian</li>
                        </ul>
                        <button id="clear-history"
                            class="mt-3 w-full fi-btn fi-btn-size-md relative grid-flow-col items-center justify-center font-semibold transition-all duration-200 focus:outline-none disabled:opacity-50 rounded-lg gap-2 px-4 py-2 text-sm bg-danger-600 hover:bg-danger-700 text-white">
                            🗑️ Hapus Riwayat
                        </button>
                    </div>
                </div>
            </div>
        </x-filament::card>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>

        <script>
            let html5QrCode = null;
            let currentCamera = null;
            let cameraList = [];
            let isScanning = false;
            let scanHistory = [];
            let activeTarget = 'checkup';
            const apiEndpoint = "{{ route('api.tickets.validate') }}";

            // UI Elements
            const startButton = document.getElementById('start-button');
            const stopButton = document.getElementById('stop-button');
            const switchCameraButton = document.getElementById('switch-camera');
            const clearHistoryButton = document.getElementById('clear-history');
            const readerDiv = document.getElementById('reader');
            const scannerPlaceholder = document.getElementById('scanner-placeholder');
            const successOverlay = document.getElementById('success-overlay');
            const loadingOverlay = document.getElementById('loading-overlay');
            const resultOverlay = document.getElementById('result-overlay');
            const scanAgainBtn = document.getElementById('scan-again-btn');
            const closeResultBtn = document.getElementById('close-result-btn');
            const historyToggle = document.getElementById('history-toggle');
            const historyContent = document.getElementById('history-content');
            const historyArrow = document.getElementById('history-arrow');

            // Event Listeners
            startButton.addEventListener('click', startScanner);
            stopButton.addEventListener('click', stopScanner);
            switchCameraButton.addEventListener('click', switchCamera);
            clearHistoryButton.addEventListener('click', clearScanHistory);
            historyToggle.addEventListener('click', toggleHistory);
            scanAgainBtn.addEventListener('click', () => {
                hideResultOverlay();
                setTimeout(startScanner, 300);
            });
            closeResultBtn.addEventListener('click', () => {
                hideResultOverlay();
                // Reset scanner state when closing popup
                resetScannerState();
            });

            document.getElementById('validate-checkup').addEventListener('click', () => setActiveTarget('checkup'));
            document.getElementById('validate-makan').addEventListener('click', () => setActiveTarget('makan'));
            document.getElementById('validate-masuk').addEventListener('click', () => setActiveTarget('masuk'));

            function setActiveTarget(target) {
                activeTarget = target;
                const targetNames = {
                    'checkup': 'Race Pack',
                    'makan': 'Makan',
                    'masuk': 'Check In'
                };
                document.getElementById('active-target').textContent = targetNames[target];

                // Remove active ring from all buttons
                document.querySelectorAll('.validate-btn').forEach(btn => {
                    btn.classList.remove('ring-4');
                    btn.classList.remove('ring-success-300', 'ring-warning-300', 'ring-purple-300');
                });

                // Add active ring to selected button
                const activeBtn = document.getElementById(`validate-${target}`);
                activeBtn.classList.add('ring-4');
                if (target === 'checkup') activeBtn.classList.add('ring-success-300');
                else if (target === 'makan') activeBtn.classList.add('ring-warning-300');
                else if (target === 'masuk') activeBtn.classList.add('ring-purple-300');
            }

            function toggleHistory() {
                historyContent.classList.toggle('hidden');
                historyArrow.classList.toggle('rotate-180');
            }

            function showLoadingOverlay() {
                loadingOverlay.classList.remove('scale-0', 'opacity-0');
                loadingOverlay.classList.add('scale-100', 'opacity-100');
            }

            function hideLoadingOverlay() {
                loadingOverlay.classList.remove('scale-100', 'opacity-100');
                loadingOverlay.classList.add('scale-0', 'opacity-0');
            }

            function showResultOverlay() {
                resultOverlay.classList.remove('scale-0', 'opacity-0');
                resultOverlay.classList.add('scale-100', 'opacity-100');
            }

            function hideResultOverlay() {
                resultOverlay.classList.remove('scale-100', 'opacity-100');
                resultOverlay.classList.add('scale-0', 'opacity-0');
            }

            function resetScannerState() {
                if (html5QrCode && isScanning) {
                    html5QrCode.stop().then(() => {
                        isScanning = false;
                        updateButtonStates();

                        // Show placeholder, hide scanner
                        scannerPlaceholder.style.display = 'flex';
                        readerDiv.style.display = 'none';

                        // Hide all overlays
                        hideAllOverlays();
                    }).catch(err => {
                        console.error("Error stopping scanner:", err);
                        // Force reset even if stop fails
                        isScanning = false;
                        updateButtonStates();
                        scannerPlaceholder.style.display = 'flex';
                        readerDiv.style.display = 'none';
                        hideAllOverlays();
                    });
                } else {
                    // If scanner is already stopped, just reset UI
                    isScanning = false;
                    updateButtonStates();
                    scannerPlaceholder.style.display = 'flex';
                    readerDiv.style.display = 'none';
                    hideAllOverlays();
                }
            }

            function hideAllOverlays() {
                successOverlay.classList.remove('scale-100', 'opacity-100');
                successOverlay.classList.add('scale-0', 'opacity-0');
                hideLoadingOverlay();
                hideResultOverlay();
            }

            async function initializeScanner() {
                html5QrCode = new Html5Qrcode("reader");
                await loadCameras();
                setActiveTarget('checkup');
            }

            async function loadCameras() {
                try {
                    cameraList = await Html5Qrcode.getCameras();
                    if (cameraList && cameraList.length) {
                        currentCamera = cameraList[0].id;
                    } else {
                        alert("Tidak ada kamera yang terdeteksi!");
                        startButton.disabled = true;
                    }
                } catch (err) {
                    console.error("Error saat mendeteksi kamera:", err);
                    alert("Error saat mencoba mengakses kamera: " + err);
                }
            }

            async function startScanner() {
                if (!html5QrCode) {
                    await initializeScanner();
                }

                if (isScanning) return;

                // Hide placeholder, show scanner
                scannerPlaceholder.style.display = 'none';
                readerDiv.style.display = 'block';
                hideResultOverlay();

                const config = {
                    fps: 10,
                    qrbox: { width: 250, height: 250 },
                    aspectRatio: 1.0
                };

                try {
                    await html5QrCode.start(currentCamera, config, onScanSuccess);
                    isScanning = true;
                    updateButtonStates();
                } catch (err) {
                    console.error("Error saat memulai scanner:", err);
                    alert("Error saat memulai pemindaian: " + err);
                    scannerPlaceholder.style.display = 'flex';
                    readerDiv.style.display = 'none';
                }
            }

            async function stopScanner() {
                if (html5QrCode && isScanning) {
                    try {
                        await html5QrCode.stop();
                        isScanning = false;
                        updateButtonStates();

                        // Show placeholder, hide scanner
                        scannerPlaceholder.style.display = 'flex';
                        readerDiv.style.display = 'none';

                        // Hide overlays
                        successOverlay.classList.remove('scale-100', 'opacity-100');
                        successOverlay.classList.add('scale-0', 'opacity-0');
                        hideLoadingOverlay();
                    } catch (err) {
                        console.error("Error saat menghentikan scanner:", err);
                    }
                }
            }

            function updateButtonStates() {
                if (isScanning) {
                    startButton.disabled = true;
                    stopButton.disabled = false;
                    startButton.classList.add('opacity-50');
                    stopButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    stopButton.classList.add('bg-danger-600', 'hover:bg-danger-700');
                } else {
                    startButton.disabled = false;
                    stopButton.disabled = true;
                    startButton.classList.remove('opacity-50');
                    stopButton.classList.add('opacity-50', 'cursor-not-allowed');
                    stopButton.classList.remove('bg-danger-600', 'hover:bg-danger-700');
                }
            }

            async function switchCamera() {
                if (!cameraList || cameraList.length <= 1) {
                    alert("Tidak ada kamera lain yang tersedia!");
                    return;
                }

                const wasScanning = isScanning;
                if (wasScanning) await stopScanner();

                const currentIndex = cameraList.findIndex(cam => cam.id === currentCamera);
                const nextIndex = (currentIndex + 1) % cameraList.length;
                currentCamera = cameraList[nextIndex].id;

                if (wasScanning) {
                    setTimeout(startScanner, 500);
                }
            }

            async function onScanSuccess(decodedText, decodedResult) {
                // Langsung hentikan scanner setelah scan berhasil
                if (isScanning) {
                    await stopScanner();
                }

                // Add to history
                addToScanHistory(decodedText, decodedResult.format?.formatName || "QR Code");

                // Tampilkan loading dan lakukan validasi
                await validateTicket(decodedText);
            }

            function showSuccessAnimation() {
                successOverlay.classList.remove('scale-0', 'opacity-0');
                successOverlay.classList.add('scale-100', 'opacity-100');

                setTimeout(() => {
                    successOverlay.classList.remove('scale-100', 'opacity-100');
                    successOverlay.classList.add('scale-0', 'opacity-0');
                }, 1200);
            }

            function playSuccessSound() {
                try {
                    const audio = new Audio("data:audio/wav;base64,UklGRvIBAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YU4BAABBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn99+mGgUbT5kwqF6aEgAc2Wz+wAAG");
                    audio.play().catch(e => console.log('Sound play failed:', e));
                } catch (e) {
                    console.error("Error playing sound:", e);
                }
            }

            async function validateTicket(qrCode) {
                // Tampilkan loading overlay
                showLoadingOverlay();

                const requestData = {
                    qr_code: qrCode,
                    target: activeTarget,
                    _token: "{{ csrf_token() }}"
                };

                try {
                    const response = await fetch(apiEndpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify(requestData)
                    });

                    const data = await response.json();

                    // Hide loading
                    hideLoadingOverlay();

                    // Jika validasi berhasil, tampilkan animasi sukses terlebih dahulu
                    if (data.success) {
                        showSuccessAnimation();
                        playSuccessSound();

                        // Tunggu animasi sukses selesai, lalu tampilkan result
                        setTimeout(() => {
                            displayValidationResult(data, qrCode);
                            showResultOverlay();
                        }, 1200);
                    } else {
                        // Langsung tampilkan hasil jika gagal
                        displayValidationResult(data, qrCode);
                        showResultOverlay();
                    }

                } catch (error) {
                    console.error('Error validating ticket:', error);
                    hideLoadingOverlay();

                    // Tampilkan error dalam popup
                    document.getElementById('result-content').innerHTML = `
                        <div class="text-center">
                            <div class="text-6xl mb-4">❌</div>
                            <h3 class="text-xl font-bold text-red-600 mb-2">Error!</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">Gagal menghubungi server: ${error.message}</p>
                        </div>
                    `;
                    showResultOverlay();
                }
            }

            function displayValidationResult(data, qrCode) {
                let resultHTML = '';

                if (data.success) {
                    resultHTML = `
                        <div class="text-center">
                            <div class="text-6xl mb-4">✅</div>
                            <h3 class="text-xl font-bold text-primary-600 mb-2">Validasi Berhasil!</h3>
                            <p class="text-lg text-primary-600 mb-6">${data.message}</p>

                            <div class="text-left bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <h4 class="font-bold text-gray-800 dark:text-gray-200 mb-3 text-center">📋 Informasi Tiket</h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="font-semibold">ID:</span>
                                        <span class="font-mono text-primary-600">${data.ticket.id || '-'}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Nama:</span>
                                        <span class="font-bold">${data.ticket.name || '-'}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">Tipe:</span>
                                        <span class="font-bold">${data.ticket.type || '-'}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">🚪 Check In:</span>
                                        <span class="${data.ticket.masuk == 1 ? 'text-green-600 font-bold' : 'text-red-500'}">${data.ticket.masuk == 1 ? '✅ Sudah' : '❌ Belum'}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">🏃‍♂️ Race Pack:</span>
                                        <span class="${data.ticket.checkup == 1 ? 'text-green-600 font-bold' : 'text-red-500'}">${data.ticket.checkup == 1 ? '✅ Sudah' : '❌ Belum'}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-semibold">🍽️ Makan:</span>
                                        <span class="${data.ticket.makan == 1 ? 'text-green-600 font-bold' : 'text-red-500'}">${data.ticket.makan == 1 ? '✅ Sudah' : '❌ Belum'}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    resultHTML = `
                        <div class="text-center">
                            <div class="text-6xl mb-4">❌</div>
                            <h3 class="text-xl font-bold text-danger-600 mb-2">Validasi Gagal!</h3>
                            <p class="text-lg text-danger-600 mb-6">${data.message}</p>

                            <div class="text-left bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <p class="font-bold text-gray-800 dark:text-gray-200 mb-2 text-center">QR Code:</p>
                                <code class="block bg-gray-100 dark:bg-gray-600 p-3 rounded text-xs font-mono break-all text-gray-800 dark:text-gray-200">${escapeHtml(qrCode)}</code>
                            </div>
                        </div>
                    `;
                }

                document.getElementById('result-content').innerHTML = resultHTML;
            }

            function addToScanHistory(code, format) {
                const exists = scanHistory.some(item => item.code === code);
                if (!exists) {
                    scanHistory.unshift({
                        code,
                        format,
                        timestamp: new Date()
                    });

                    if (scanHistory.length > 10) {
                        scanHistory.pop();
                    }

                    updateScanHistoryDisplay();
                }
            }

            function updateScanHistoryDisplay() {
                const historyList = document.getElementById('history-list');
                historyList.innerHTML = '';

                if (scanHistory.length === 0) {
                    const li = document.createElement('li');
                    li.className = "p-3 text-gray-600 dark:text-gray-400 text-center";
                    li.textContent = "Belum ada riwayat pemindaian";
                    historyList.appendChild(li);
                    return;
                }

                scanHistory.forEach((item) => {
                    const li = document.createElement('li');
                    li.className = "p-3 bg-gray-50 dark:bg-gray-800 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors";
                    const time = item.timestamp.toLocaleTimeString();
                    li.innerHTML = `
                        <div class="flex justify-between items-center">
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-800 dark:text-gray-200 truncate">${escapeHtml(item.code.substring(0, 30))}${item.code.length > 30 ? '...' : ''}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">${time}</p>
                            </div>
                            <span class="ml-2 px-2 py-1 bg-primary-500 text-white text-xs font-bold rounded-full">${item.format}</span>
                        </div>
                    `;
                    li.title = item.code;
                    historyList.appendChild(li);
                });
            }

            function clearScanHistory() {
                if (confirm("Apakah Anda yakin ingin menghapus semua riwayat pemindaian?")) {
                    scanHistory = [];
                    updateScanHistoryDisplay();
                }
            }

            function escapeHtml(unsafe) {
                return unsafe
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }

            // Initialize when DOM is ready
            document.addEventListener('DOMContentLoaded', function() {
                initializeScanner();
                updateScanHistoryDisplay();
            });
        </script>
    @endpush
</x-filament::page>