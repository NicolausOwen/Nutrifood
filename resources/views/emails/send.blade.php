<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket Kamu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            padding: 30px;
            text-align: center;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .qr {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Halo, {{ $ticket->user->name }}</h1>
    <p>Tiket kamu berhasil dibuat! Berikut adalah kode QR:</p>
    <div class="qr">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $ticket->qr_code }}" alt="QR Code">
    </div>
    <p>Terima kasih sudah menggunakan layanan kami! 🎉</p>
</div>
</body>
</html>
