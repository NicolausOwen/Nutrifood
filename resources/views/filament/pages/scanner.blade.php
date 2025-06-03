<x-filament::page>
    <div class="space-y-6 max-w-5xl mx-auto">
        <!-- Header dan Scanner -->
        <div class="text-center">
            <h1 class="text-2xl font-bold text-primary-600 dark:text-primary-400 mb-4">Tiket Scanner</h1>
            <div id="reader"
                class="w-full mx-auto border-2 border-primary-500 rounded-lg shadow-md overflow-hidden mb-4"
                style="height: 400px;"></div>
        </div>

        <!-- Main Card Container -->
        <x-filament::card>
            <div class="p-6 space-y-6">
                <!-- Scanner Controls -->
                <div class="flex flex-wrap justify-center gap-3">
                    <button id="start-button"
                        class="fi-btn fi-btn-size-md relative grid-flow-col items-center justify-center font-semibold transition-colors focus:outline-none disabled:opacity-70 rounded-lg gap-1.5 px-4 py-2 text-sm bg-primary-600 hover:bg-primary-500 text-white">
                        <span class="fi-btn-label">Mulai Pemindaian</span>
                    </button>
                    <button id="stop-button" disabled
                        class="fi-btn fi-btn-size-md relative grid-flow-col items-center justify-center font-semibold transition-colors focus:outline-none disabled:opacity-70 rounded-lg gap-1.5 px-4 py-2 text-sm bg-gray-500 text-white cursor-not-allowed">
                        <span class="fi-btn-label">Hentikan Pemindaian</span>
                    </button>
                    <button id="switch-camera"
                        class="fi-btn fi-btn-size-md relative grid-flow-col items-center justify-center font-semibold transition-colors focus:outline-none disabled:opacity-70 rounded-lg gap-1.5 px-4 py-2 text-sm bg-gray-600 hover:bg-gray-500 text-white">
                        <span class="fi-btn-label">Ganti Kamera</span>
                    </button>
                    <button id="clear-history"
                        class="fi-btn fi-btn-size-md relative grid-flow-col items-center justify-center font-semibold transition-colors focus:outline-none disabled:opacity-70 rounded-lg gap-1.5 px-4 py-2 text-sm bg-danger-600 hover:bg-danger-500 text-white">
                        <span class="fi-btn-label">Hapus Riwayat</span>
                    </button>
                </div>

                <!-- Validation Target -->
                <x-filament::card>
                    <div class="p-4 space-y-3">
                        <h3
                            class="text-lg font-medium text-gray-900 dark:text-white pb-2 border-b border-gray-200 dark:border-gray-700">
                            Pilih Target Validasi
                        </h3>
                        <div class="flex flex-wrap justify-center gap-2">
                            <button id="validate-masuk"
                                class="validate-btn fi-btn fi-btn-size-md relative grid-flow-col items-center justify-center font-semibold transition-colors focus:outline-none disabled:opacity-70 rounded-lg gap-1.5 px-4 py-2 text-sm bg-purple-600 hover:bg-purple-500 text-white">
                                <span class="fi-btn-label">Check In</span>
                            </button>
                            <button id="validate-checkup"
                                class="validate-btn fi-btn fi-btn-size-md relative grid-flow-col items-center justify-center font-semibold transition-colors focus:outline-none disabled:opacity-70 rounded-lg gap-1.5 px-4 py-2 text-sm bg-success-600 hover:bg-success-500 text-white ring-4 ring-primary-300">
                                <span class="fi-btn-label">Checkup</span>
                            </button>
                            <button id="validate-makan"
                                class="validate-btn fi-btn fi-btn-size-md relative grid-flow-col items-center justify-center font-semibold transition-colors focus:outline-none disabled:opacity-70 rounded-lg gap-1.5 px-4 py-2 text-sm bg-warning-600 hover:bg-warning-500 text-white">
                                <span class="fi-btn-label">Makan</span>
                            </button>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                            Target aktif: <span id="active-target"
                                class="font-medium text-primary-600 dark:text-primary-400">checkup</span>
                        </p>
                    </div>
                </x-filament::card>

                <!-- Settings Section -->
                <div class="space-y-3">
                    <button id="settings-toggle"
                        class="fi-btn fi-btn-size-md w-full relative grid-flow-col items-center justify-center font-semibold transition-colors focus:outline-none disabled:opacity-70 rounded-lg gap-1.5 px-4 py-2 text-sm bg-warning-600 hover:bg-warning-500 text-white">
                        <span class="fi-btn-label">Pengaturan Scanner ⚙️</span>
                    </button>

                    <div id="settings-panel" class="hidden">
                        <x-filament::card>
                            <div class="p-4 space-y-3">
                                <h3
                                    class="text-lg font-medium text-gray-900 dark:text-white pb-2 border-b border-gray-200 dark:border-gray-700">
                                    Pengaturan Scanner
                                </h3>
                                <div class="space-y-1">
                                    <label for="camera-select"
                                        class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Pilih Kamera
                                    </label>
                                    <select id="camera-select"
                                        class="fi-select-input block w-full transition duration-75 rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 disabled:opacity-70 text-sm">
                                        <!-- Camera options will be populated by JavaScript -->
                                    </select>
                                </div>
                            </div>
                        </x-filament::card>
                    </div>
                </div>

                <!-- Result Display -->
                <x-filament::card>
                    <div id="result" class="p-4 break-words text-sm text-gray-800 dark:text-gray-200">
                        Hasil pemindaian akan muncul di sini
                    </div>
                </x-filament::card>

                <!-- Scan History -->
                <x-filament::card>
                    <div class="p-4 space-y-3">
                        <h3
                            class="text-lg font-medium text-gray-900 dark:text-white pb-2 border-b border-gray-200 dark:border-gray-700">
                            Riwayat Pemindaian
                        </h3>
                        <ul id="history-list"
                            class="divide-y divide-gray-200 dark:divide-gray-700 max-h-64 overflow-y-auto text-sm">
                            <li class="py-2 text-gray-600 dark:text-gray-400">Belum ada riwayat pemindaian</li>
                        </ul>
                    </div>
                </x-filament::card>
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

            // Inisialisasi elemen UI
            const startButton = document.getElementById('start-button');
            const stopButton = document.getElementById('stop-button');
            const switchCameraButton = document.getElementById('switch-camera');
            const clearHistoryButton = document.getElementById('clear-history');
            const settingsToggleButton = document.getElementById('settings-toggle');
            const cameraSelect = document.getElementById('camera-select');
            const validateCheckupBtn = document.getElementById('validate-checkup');
            const validateMakanBtn = document.getElementById('validate-makan');
            const validateUsedBtn = document.getElementById('validate-masuk');

            // Event listeners
            startButton.addEventListener('click', startScanner);
            stopButton.addEventListener('click', stopScanner);
            switchCameraButton.addEventListener('click', switchCamera);
            clearHistoryButton.addEventListener('click', clearScanHistory);
            settingsToggleButton.addEventListener('click', toggleSettings);
            validateCheckupBtn.addEventListener('click', () => setActiveTarget('checkup'));
            validateMakanBtn.addEventListener('click', () => setActiveTarget('makan'));
            validateUsedBtn.addEventListener('click', () => setActiveTarget('masuk'));

            // Fungsi utama
            function setActiveTarget(target) {
                activeTarget = target;
                document.getElementById('active-target').textContent = target;

                const buttons = document.querySelectorAll('.validate-btn');
                buttons.forEach(btn => {
                    btn.classList.remove('ring-4', 'ring-primary-300');
                });

                document.getElementById(`validate-${target}`).classList.add('ring-4', 'ring-primary-300');
            }

            function initializeScanner() {
                html5QrCode = new Html5Qrcode("reader");
                loadCameras();
                setActiveTarget('checkup');
            }

            async function loadCameras() {
                try {
                    cameraList = await Html5Qrcode.getCameras();
                    if (cameraList && cameraList.length) {
                        cameraSelect.innerHTML = '';
                        cameraList.forEach(camera => {
                            const option = document.createElement('option');
                            option.value = camera.id;
                            option.text = camera.label || `Camera ${cameraList.indexOf(camera) + 1}`;
                            cameraSelect.appendChild(option);
                        });
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

            function startScanner() {
                if (!html5QrCode) {
                    initializeScanner();
                    return;
                }

                if (isScanning) {
                    stopScanner();
                    return;
                }

                const selectedCameraId = cameraSelect.value || currentCamera;
                if (!selectedCameraId) {
                    alert("Silakan pilih kamera terlebih dahulu!");
                    return;
                }

                const config = {
                    fps: 10,
                    qrbox: {
                        width: 500,
                        height: 400
                    }
                };

                html5QrCode.start(
                        selectedCameraId,
                        config,
                        onScanSuccess
                    )
                    .then(() => {
                        isScanning = true;
                        startButton.disabled = true;
                        stopButton.disabled = false;
                        startButton.classList.remove('bg-primary-600', 'hover:bg-primary-500');
                        startButton.classList.add('bg-gray-500');
                        stopButton.classList.remove('bg-gray-500');
                        stopButton.classList.add('bg-danger-600', 'hover:bg-danger-500');
                        document.getElementById('result').innerHTML = "Pemindaian sedang berjalan...";
                    })
                    .catch(err => {
                        console.error("Error saat memulai scanner:", err);
                        alert("Error saat memulai pemindaian: " + err);
                    })
            }

            function stopScanner() {
                if (html5QrCode && isScanning) {
                    html5QrCode.stop()
                        .then(() => {
                            isScanning = false;
                            startButton.disabled = false;
                            stopButton.disabled = true;
                            startButton.classList.remove('bg-gray-400');
                            startButton.classList.add('bg-primary-500', 'hover:bg-primary-600');
                            stopButton.classList.remove('bg-danger-500', 'hover:bg-danger-600');
                            stopButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                        })
                        .catch(err => {
                            console.error("Error saat menghentikan scanner:", err);
                        });
                }
            }

            function switchCamera() {
                if (!cameraList || cameraList.length <= 1) {
                    alert("Tidak ada kamera lain yang tersedia!");
                    return;
                }

                const wasScanning = isScanning;
                if (wasScanning) {
                    stopScanner();
                }

                const currentIndex = cameraList.findIndex(cam => cam.id === currentCamera);
                const nextIndex = (currentIndex + 1) % cameraList.length;
                currentCamera = cameraList[nextIndex].id;
                cameraSelect.value = currentCamera;

                if (wasScanning) {
                    setTimeout(startScanner, 500);
                }
            }

            function onScanSuccess(decodedText, decodedResult) {
                stopScanner();
                addToScanHistory(decodedText, decodedResult.format?.formatName || "Unknown");
                validateTicket(decodedText);

                try {
                    new Audio("data:audio/wav;base64,UklGRl9vT19XQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YU").play();
                } catch (e) {
                    console.error("Error playing sound:", e);
                }
            }

            function validateTicket(qrCode) {
                document.getElementById('result').innerHTML = `
                    <div class="flex items-center justify-center p-4">
                        <div class="w-6 h-6 border-2 border-t-2 border-primary-500 rounded-full animate-spin mr-2"></div>
                        <p>Memvalidasi tiket...</p>
                    </div>
                `;

                const requestData = {
                    qr_code: qrCode,
                    target: activeTarget,
                    _token: "{{ csrf_token() }}"
                };

                fetch(apiEndpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify(requestData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        displayValidationResult(data, qrCode);
                    })
                    .catch(error => {
                        console.error('Error validating ticket:', error);
                        document.getElementById('result').innerHTML = `
                        <div class="p-4 bg-danger-100 border border-danger-400 text-danger-700 rounded mb-3">
                            <h3 class="font-bold">Error!</h3>
                            <p>Gagal menghubungi server: ${error.message}</p>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <p class="font-bold">QR Code:</p>
                            <code class="block bg-gray-100 p-2 rounded">${escapeHtml(qrCode)}</code>
                        </div>
                    `;
                    });
            }

            function displayValidationResult(data, qrCode) {
                let resultHTML = '';

                if (data.success) {
                    resultHTML = `
                        <div class="p-4 bg-success-100 border border-success-400 text-success-700 rounded mb-3">
                            <h3 class="font-bold text-lg">Validasi Berhasil!</h3>
                            <p>${data.message}</p>
                        </div>
                        <div class="mt-3">
                            <h4 class="font-bold">Informasi Tiket:</h4>
                            <div class="grid grid-cols-2 gap-2 mt-2">
                                <div class="font-semibold">ID Tiket:</div>
                                <div>${data.ticket.id || '-'}</div>
                                <div class="font-semibold">Check In:</div>
                                <div>${data.ticket.masuk == 1 ? '✅ Sudah' : '❌ Belum'}</div>
                                <div class="font-semibold">Race-Pack:</div>
                                <div>${data.ticket.checkup == 1 ? '✅ Sudah' : '❌ Belum'}</div>
                                <div class="font-semibold">Makan:</div>
                                <div>${data.ticket.makan == 1 ? '✅ Sudah' : '❌ Belum'}</div>
                            </div>
                        </div>
                    `;
                } else {
                    resultHTML = `
                        <div class="p-4 bg-danger-100 border border-danger-400 text-danger-700 rounded mb-3">
                            <h3 class="font-bold text-lg">Validasi Gagal!</h3>
                            <p>${data.message}</p>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <p class="font-bold">QR Code:</p>
                            <code class="block bg-gray-100 p-2 rounded">${escapeHtml(qrCode)}</code>
                        </div>
                    `;
                }

                document.getElementById('result').innerHTML = resultHTML;
            }

            function escapeHtml(unsafe) {
                return unsafe
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
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
                    li.textContent = "Belum ada riwayat pemindaian";
                    li.className = "py-2";
                    historyList.appendChild(li);
                    return;
                }

                scanHistory.forEach((item, index) => {
                    const li = document.createElement('li');
                    li.className =
                        "py-2 border-b border-gray-200 dark:border-gray-700 last:border-b-0 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700";
                    const time = item.timestamp.toLocaleTimeString();
                    li.innerHTML =
                        `<span class="font-semibold">${escapeHtml(item.code.substring(0, 20))}${item.code.length > 20 ? '...' : ''}</span> <span class="inline-block px-2 py-1 rounded-full bg-primary-500 text-white text-xs font-bold">${item.format}</span> <small class="text-gray-500 dark:text-gray-400">(${time})</small>`;
                    li.title = item.code;
                    li.addEventListener('click', () => {
                        processBarcode(item.code, item.format);
                    });
                    historyList.appendChild(li);
                });
            }

            function clearScanHistory() {
                if (confirm("Apakah Anda yakin ingin menghapus semua riwayat pemindaian?")) {
                    scanHistory = [];
                    updateScanHistoryDisplay();
                }
            }

            function toggleSettings() {
                const settingsPanel = document.getElementById('settings-panel');
                settingsPanel.classList.toggle('hidden');
                if (settingsPanel.classList.contains('hidden')) {
                    settingsToggleButton.textContent = "Pengaturan Scanner ⚙️";
                } else {
                    settingsToggleButton.textContent = "Sembunyikan Pengaturan ⚙️";
                }
            }

            // Inisialisasi saat DOM siap
            document.addEventListener('DOMContentLoaded', function() {
                initializeScanner();
                updateScanHistoryDisplay();
            });
        </script>
    @endpush
</x-filament::page>
