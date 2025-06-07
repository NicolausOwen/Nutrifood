<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-ticket Kamu</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; margin-top: 30px; border-radius: 16px; overflow: hidden;">

                    <!-- Header Gambar -->
                    <tr>
                        <td>
                            <img src="https://hilo-sarcopenia.ddns.net/strongfest-header.png" alt="HiLo Strong Fest" width="100%" style="display: block;">
                        </td>
                    </tr>

                    <!-- Sapaan -->
                    <tr>
                        <td style="padding: 24px;">
                            <h2 style="margin: 0; font-size: 18px;">Hai, <strong>{{ $ticket->name }}</strong></h2>
                            <p style="font-size: 14px;">Boom! Order sukses, tiket kamu resmi jadi milikmu! 🎉</p>
                            <p style="font-size: 14px;"><strong>{{ $ticket->event_name ?? 'HiLo StrongFest' }}</strong> tinggal hitungan hari. Yuk, cek semua info penting di bawah dan siap-siap buat pengalaman luar biasa! 🌿</p>
                        </td>
                    </tr>

                    <!-- Container dengan border -->
                    <tr>
                        <td style="padding: 0 24px 24px;">
                            <div style="border: 1px solid black; border-radius: 16px; padding: 24px;">

                                <!-- Detail Tiket -->
                                <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f9f9f9; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                                    <tr>
                                        <td colspan="2" align="center" style="padding-top: 16px;">
                                            <img src="https://hilo-sarcopenia.ddns.net/StrongFest.png" width="200" alt="Strong Fest">
                                        </td>
                                    </tr>
                                    <tr><td colspan="2" style="height: 16px;"></td></tr>
                                    <tr><td><strong>Nama:</strong></td><td>{{ $ticket->name }}</td></tr>
                                    <tr><td><strong>ID Tiket:</strong></td><td>{{ $ticket->id ?? 'BLA-0000' }}</td></tr>
                                    <tr><td><strong>Event:</strong></td><td>{{ $ticket->event_name ?? 'HiLo StrongFest' }}</td></tr>
                                    <tr><td><strong>Tanggal:</strong></td><td>Sabtu, 05 Juli 2025</td></tr>
                                    <tr><td><strong>Waktu:</strong></td><td>16.00 WIB</td></tr>
                                    <tr><td><strong>Lokasi:</strong></td><td>Ballroom Aryaduta Palembang</td></tr>
                                </table>

                                {{-- <!-- Invoice -->
                                <table width="100%" style="margin-bottom: 20px;">
                                    <tr style="background-color: #4a61dd;">
                                        <td align="left" style="padding: 0 16px;">
                                            <h3>INVOICE</h3>
                                        </td>
                                        <td align="right" style="padding: 0 16px;">
                                            {{ $ticket->user->name }}
                                        </td>
                                    </tr>
                                </table>
                                <p><strong>Metode Pembayaran:</strong> {{ $ticket->payment_method ?? 'BCA Virtual Account' }}</p>
                                <p><strong>Total Pembayaran:</strong> Rp{{ number_format($ticket->amount ?? 150000, 0, ',', '.') }}</p>
                                <p><strong>Status:</strong> <span style="color: green;">Lunas ✅</span></p>
                                <p><strong>Tanggal Pembelian:</strong> {{ $ticket->purchase_date ?? '15 April 2025' }}</p> --}}

                                <!-- Gambar Tiket & QR -->
                                <div align="center" style="padding: 20px 0;">
                                    <table cellpadding="0" cellspacing="0" width="100%" style="background-color: #ffffff; border-radius: 16px; border: 1px solid #e0e0e0; max-width: 480px; margin: auto; font-family: Arial, sans-serif;">
                                        <tr>
                                            <!-- Sidebar Vertikal -->
                                            <td width="40" style="background-color: #1f3089; color: #fff; text-align: center; font-size: 20px; font-weight: bold;">
                                                <div style="writing-mode: vertical-lr; transform: rotate(180deg); padding: 12px 0;">
                                                    <pre>
                                                        HILO STRONGFEST   HILO STRONGFEST   HILO STRONGFEST   HILO STRONGFEST
                                                    </pre>
                                                </div>
                                            </td>

                                            <!-- Tiket Atas -->
                                            <td style="padding: 20px; font-size: 14px;">
                                                <p style="margin: 0 0 8px 0;">Hi, <strong>{{ $ticket->user->name }}</strong></p>
                                                <p style="margin: 0 0 16px 0; font-weight: bold;">Selamat! Pembayaran kamu sudah berhasil kami terima.</p>

                                                <p style="margin: 0 0 8px 0;"><strong>HILO STRONGFEST</strong></p>

                                                <!-- Garis Potong dan Lekukan -->
                                                ------------------------------------------------------------------

                                                <table width="100%" style="margin-bottom: 20px;">
                                                    <tr>
                                                        <td align="left" style="font-size: 14px;">
                                                            <strong>ID:</strong> {{ $ticket->id ?? 'BLA-0000' }}
                                                        </td>
                                                        <td align="right" style="font-size: 12px; color: #888;">
                                                            {{ $ticket->purchase_date ?? now() }}
                                                        </td>
                                                    </tr>
                                                </table>

                                                <!-- QR Code -->
                                                <div style="text-align: center; margin: 20px 0;">
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $ticket->qr_code }}" alt="QR Code" style="border-radius: 8px;">
                                                </div>

                                                <!-- Detail Event -->
                                                <table style="width: 100%; font-size: 14px;">
                                                    <tr>
                                                        <td style="padding: 4px 0;"><strong>Tanggal</strong></td>
                                                        <td style="padding: 4px 0;">: 05 Juli 2025</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 4px 0;"><strong>Waktu</strong></td>
                                                        <td style="padding: 4px 0;">: 16.00 WIB</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 4px 0;"><strong>Lokasi</strong></td>
                                                        <td style="padding: 4px 0;">: Ballroom Aryaduta Palembang </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                {{-- <!-- Tombol Unduh -->
                                <div align="center" style="padding: 20px;">
                                    <a href="{{ $ticket->download_url }}" style="display: inline-block; padding: 12px 24px; background-color: #4a61dd; color: white; text-decoration: none; border-radius: 30px; font-weight: bold;">Unduh Tiket</a>
                                </div> --}}

                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px; text-align: center; font-size: 14px; color: #333;">
                            Terima kasih telah mempercayai kami. Nikmati acaranya dan sampai bertemu di <strong>{{ $ticket->event_name ?? 'HiLo StrongFest' }}</strong>!<br><br>
                            Salam hangat,<br>
                            <strong>Tim HILO STRONGFEST</strong>
                        </td>
                    </tr>
                    <tr><td style="height: 30px;"></td></tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
