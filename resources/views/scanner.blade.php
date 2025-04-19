<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Scanner</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="max-w-3xl mx-auto p-5 text-center">
        <h1 class="text-2xl font-bold mb-5">Tiket Scanner</h1>

        <div class="flex flex-col items-center gap-5">
            <div id="reader" class="w-full max-w-lg border-2 border-blue-500 rounded-lg shadow-md overflow-hidden mb-5"></div>

            <div class="flex flex-wrap justify-center gap-2 mb-4">
                <button id="start-button" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded transition-colors">Mulai Pemindaian</button>
                <button id="stop-button" disabled class="bg-gray-400 text-white px-5 py-2 rounded cursor-not-allowed">Hentikan Pemindaian</button>
                <button id="switch-camera" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded transition-colors">Ganti Kamera</button>
                <button id="clear-history" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded transition-colors">Hapus Riwayat</button>
            </div>

            <div class="w-full max-w-lg mb-5">
                <div class="bg-white p-4 border border-gray-300 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4 text-left">Pilih Target Validasi:</h3>
                    <div class="flex flex-wrap gap-3 justify-center">
                        <button id="validate-checkup" class="validate-btn bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition-colors">Checkup</button>
                        <button id="validate-makan" class="validate-btn bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition-colors">Makan</button>
                        <button id="validate-used" class="validate-btn bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded transition-colors">Used</button>
                    </div>
                    <div class="mt-3 text-left">
                        <p>Target aktif: <span id="active-target" class="font-bold text-blue-600">checkup</span></p>
                    </div>
                </div>
            </div>

            <button id="settings-toggle" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded transition-colors mt-2">Pengaturan Scanner ⚙️</button>

            <div id="settings-panel" class="hidden w-full max-w-lg">
                <div class="mb-4 bg-white p-4 border border-gray-300 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-3 text-left">Pengaturan Scanner</h3>
                    <div class="mb-4">
                        <label for="camera-select" class="block text-left mb-1">Pilih Kamera:</label>
                        <select id="camera-select" class="w-full p-2 border border-gray-300 rounded">
                        </select>
                    </div>
                </div>
            </div>

            <div id="result" class="w-full max-w-lg p-4 bg-white border border-gray-300 rounded-lg shadow-sm text-left break-all">
                Hasil pemindaian akan muncul di sini
            </div>

            <div id="history" class="w-full max-w-lg bg-white p-4 border border-gray-300 rounded-lg shadow-sm mt-5">
                <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-2 text-left">Riwayat Pemindaian</h3>
                <ul id="history-list" class="list-none p-0 m-0 max-h-48 overflow-y-auto text-left"></ul>
            </div>
        </div>
    </div>

    <script>
        let html5QrCode = null;
        let currentCamera = null;
        let cameraList = [];
        let isScanning = false;
        let scanHistory = [];
        let activeTarget = 'checkup';

        const startButton = document.getElementById('start-button');
        const stopButton = document.getElementById('stop-button');
        const switchCameraButton = document.getElementById('switch-camera');
        const clearHistoryButton = document.getElementById('clear-history');
        const processManualButton = document.getElementById('process-manual');
        const settingsToggleButton = document.getElementById('settings-toggle');
        const cameraSelect = document.getElementById('camera-select');

        const validateCheckupBtn = document.getElementById('validate-checkup');
        const validateMakanBtn = document.getElementById('validate-makan');
        const validateUsedBtn = document.getElementById('validate-used');

        startButton.addEventListener('click', startScanner);
        stopButton.addEventListener('click', stopScanner);
        switchCameraButton.addEventListener('click', switchCamera);
        clearHistoryButton.addEventListener('click', clearScanHistory);
        settingsToggleButton.addEventListener('click', toggleSettings);

        validateCheckupBtn.addEventListener('click', () => setActiveTarget('checkup'));
        validateMakanBtn.addEventListener('click', () => setActiveTarget('makan'));
        validateUsedBtn.addEventListener('click', () => setActiveTarget('used'));

        function setActiveTarget(target) {
            activeTarget = target;
            document.getElementById('active-target').textContent = target;

            const buttons = document.querySelectorAll('.validate-btn');
            buttons.forEach(btn => {
                btn.classList.remove('ring-4', 'ring-blue-300');
            });

            document.getElementById(`validate-${target}`).classList.add('ring-4', 'ring-blue-300');
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
                qrbox: { width: 300, height: 200 }
            };

            html5QrCode.start(
                selectedCameraId,
                config,
                onScanSuccess,
                onScanFailure
            )
            .then(() => {
                isScanning = true;
                startButton.disabled = true;
                stopButton.disabled = false;
                startButton.classList.add('bg-gray-400');
                startButton.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                stopButton.classList.add('bg-red-500', 'hover:bg-red-600');
                stopButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                document.getElementById('result').innerHTML = "Pemindaian sedang berjalan...";
            })
            .catch(err => {
                console.error("Error saat memulai scanner:", err);
                alert("Error saat memulai pemindaian: " + err);
            });
        }

        function stopScanner() {
            if (html5QrCode && isScanning) {
                html5QrCode.stop()
                    .then(() => {
                        isScanning = false;
                        startButton.disabled = false;
                        stopButton.disabled = true;
                        startButton.classList.remove('bg-gray-400');
                        startButton.classList.add('bg-blue-500', 'hover:bg-blue-600');
                        stopButton.classList.remove('bg-red-500', 'hover:bg-red-600');
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
            addToScanHistory(decodedText, decodedResult.format?.formatName || "Unknown");

            validateTicket(decodedText);

            try {
                new Audio("data:audio/wav;base64,UklGRl9vT19XQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YU").
                    play();
            } catch(e) {

            }
        }

        function validateTicket(qrCode) {
            const apiUrl = '/api/tickets/validate';

            document.getElementById('result').innerHTML = `
                <div class="flex items-center justify-center p-4">
                    <div class="w-6 h-6 border-2 border-t-2 border-blue-500 rounded-full animate-spin mr-2"></div>
                    <p>Memvalidasi tiket...</p>
                </div>
            `;

            const requestData = {
                qr_code: qrCode,
                target: activeTarget
            };

            fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
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
                    <div class="p-4 bg-red-100 border border-red-400 text-red-700 rounded mb-3">
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
                    <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded mb-3">
                        <h3 class="font-bold text-lg">Validasi Berhasil!</h3>
                        <p>${data.message}</p>
                    </div>
                    <div class="mt-3">
                        <h4 class="font-bold">Informasi Tiket:</h4>
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            <div class="font-semibold">ID Tiket:</div>
                            <div>${data.ticket.id || '-'}</div>
                            <div class="font-semibold">User ID:</div>
                            <div>${data.ticket.id_user || '-'}</div>
                            <div class="font-semibold">Checkup:</div>
                            <div>${data.ticket.checkup ? '✅ Sudah' : '❌ Belum'}</div>
                            <div class="font-semibold">Makan:</div>
                            <div>${data.ticket.makan ? '✅ Sudah' : '❌ Belum'}</div>
                            <div class="font-semibold">Used:</div>
                            <div>${data.ticket.used ? '✅ Sudah' : '❌ Belum'}</div>
                        </div>
                    </div>
                `;
            } else {
                resultHTML = `
                    <div class="p-4 bg-red-100 border border-red-400 text-red-700 rounded mb-3">
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

        function processBarcode(code, format) {
            let resultHTML = `
                <h3 class="text-lg font-semibold mb-2">Hasil Pemindaian:</h3>
                <p class="mb-1"><span class="font-bold">Data:</span> <code>${escapeHtml(code)}</code></p>
                <p class="mb-1"><span class="font-bold">Format:</span> <span class="inline-block px-2 py-1 rounded-full bg-blue-500 text-white text-xs font-bold">${format}</span></p>
                <p class="mb-1"><span class="font-bold">Panjang:</span> ${code.length} karakter</p>
                <button id="validate-scan" class="mt-3 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition-colors">Validasi Tiket</button>
            `;

            document.getElementById('result').innerHTML = resultHTML;

            document.getElementById('validate-scan').addEventListener('click', () => {
                validateTicket(code);
            });
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
                li.className = "py-2 border-b border-gray-200 last:border-b-0 cursor-pointer hover:bg-gray-100";
                const time = item.timestamp.toLocaleTimeString();
                li.innerHTML = `<span class="font-semibold">${escapeHtml(item.code.substring(0, 20))}${item.code.length > 20 ? '...' : ''}</span> <span class="inline-block px-2 py-1 rounded-full bg-blue-500 text-white text-xs font-bold">${item.format}</span> <small class="text-gray-500">(${time})</small>`;
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

        document.addEventListener('DOMContentLoaded', function() {
            initializeScanner();
            updateScanHistoryDisplay();
        });
    </script>
</body>
</html>