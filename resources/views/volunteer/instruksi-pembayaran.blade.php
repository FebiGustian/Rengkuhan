<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Instruksi Pembayaran | Ranah Rengkuh</title>

<style>
* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
    background: #eaf3ff;
    color: #3b2f66;
}

/* SIDEBAR FIGMA */
.sidebar { position: fixed; inset: 0 auto 0 0; width: 220px; background: #ded7f4; padding: 24px 16px; display: flex; flex-direction: column; z-index: 10; }
.brand { padding: 0 8px 24px; }
.brand img { width: 140px; max-height: 60px; object-fit: contain; }
.menu { display: flex; flex-direction: column; gap: 8px; margin-top: 10px; }
.menu a { display: flex; align-items: center; gap: 14px; padding: 12px 14px; border-radius: 10px; color: #55447a; text-decoration: none; font-size: 14px; font-weight: 600; transition: all .2s; }
.menu a:hover, .menu a.active { background: #5d4692; color: white; }
.logout-box { margin-top: auto; padding-top: 20px; }
.logout-box button { width: 100%; border: none; background: transparent; color: #55447a; display: flex; align-items: center; gap: 12px; padding: 12px 14px; font-size: 14px; font-weight: 600; cursor: pointer; border-radius: 10px; }
.logout-box button:hover { background: rgba(93, 70, 146, 0.12); }

/* MAIN */
.main { margin-left: 220px; min-height: 100vh; }
.topbar { height: 58px; background: #7bbcf5; display: flex; justify-content: space-between; align-items: center; padding: 0 32px; color: #2e2154; font-size: 13px; font-weight: 600; }
.breadcrumb { color: #2b1d56; }
.topbar-right { display: flex; align-items: center; gap: 16px; }
.user-profile { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 700; }
.user-avatar { width: 30px; height: 30px; background: #ffffff; border-radius: 50%; display: grid; place-items: center; font-size: 13px; color: #5d4692; }

.content { padding: 28px 32px 50px; }
.page-title { font-size: 26px; font-weight: 800; color: #3b2a68; margin: 0 0 6px; }
.page-subtitle { font-size: 13px; color: #6a5c8e; margin: 0 0 24px; }

/* LAYOUT GRID FIGMA */
.payment-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.8fr) minmax(310px, 1fr);
    gap: 24px;
    align-items: start;
}

/* CARD KIRI FIGMA */
.payment-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 26px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.05);
}

.status-banner-pending {
    background: #fff8e6;
    color: #925c04;
    padding: 12px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 22px;
}

.method-title {
    font-size: 17px;
    font-weight: 800;
    color: #3b2a68;
    margin-bottom: 14px;
}

/* QRIS & VA DISPLAY BOX */
.qris-display-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #faf8fe;
    border: 2px dashed #a491ce;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 20px;
    text-align: center;
}

.qris-qr-image {
    width: 180px;
    height: 180px;
    object-fit: contain;
    background: #ffffff;
    padding: 8px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    margin-bottom: 10px;
}

.va-number-box {
    background: #ffffff;
    border: 1px solid #d4c8ea;
    border-radius: 10px;
    padding: 12px 20px;
    font-size: 22px;
    font-weight: 800;
    color: #3b2a68;
    letter-spacing: 2px;
    margin: 8px 0;
}

.instruction-list {
    margin: 0 0 24px;
    padding-left: 20px;
    font-size: 13px;
    color: #55447a;
    line-height: 1.8;
}

/* KODE BOX */
.kode-box {
    background: #f8f6fd;
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 14px;
}

.kode-box small { display: block; font-size: 11px; color: #887b9e; margin-bottom: 4px; }
.kode-box strong { font-size: 20px; font-weight: 800; color: #3b2a68; letter-spacing: 1px; }

.btn-salin {
    width: 100%;
    padding: 12px;
    background: #ffffff;
    border: 1px solid #d4c9ea;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    color: #4b367d;
    cursor: pointer;
    transition: background .2s;
    margin-bottom: 12px;
}

.btn-salin:hover { background: #f6f3fc; }

/* KANAN FIGMA */
.summary-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.05);
}

.summary-card h3 { margin: 0 0 8px; font-size: 17px; font-weight: 800; color: #3b2a68; }
.summary-user-meta { font-size: 12px; color: #7b6f98; margin-bottom: 6px; }
.summary-date-meta { font-size: 12px; color: #8f84aa; margin-bottom: 20px; }

.total-pay-box {
    background: #f8f6fd;
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 18px;
}

.total-pay-box small { display: block; font-size: 11px; color: #7e719c; margin-bottom: 4px; }
.total-pay-box strong { font-size: 26px; font-weight: 800; color: #3b2a68; }

.btn-simulasi-bayar {
    width: 100%;
    padding: 14px;
    background: #17834a;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(23, 131, 74, 0.25);
    transition: background .2s, transform .2s;
    margin-bottom: 10px;
}

.btn-simulasi-bayar:hover {
    background: #126739;
    transform: translateY(-2px);
}

.btn-cek-status {
    width: 100%;
    padding: 12px;
    background: #5d4692;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    margin-bottom: 10px;
    text-align: center;
    text-decoration: none;
    display: block;
}

.btn-kembali-secondary {
    width: 100%;
    padding: 11px;
    background: #ffffff;
    border: 1px solid #d4c9ea;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
    color: #55447a;
    text-align: center;
    text-decoration: none;
    display: block;
    margin-bottom: 14px;
}

.simulasi-banner {
    background: #ebf5ff;
    border-left: 4px solid #3b82f6;
    padding: 10px 14px;
    border-radius: 6px;
    font-size: 11px;
    color: #1e40af;
    line-height: 1.5;
    margin-top: 14px;
}

@media(max-width: 900px) {
    .payment-grid { grid-template-columns: 1fr; }
    .sidebar { position: relative; width: 100%; }
    .main { margin-left: 0; }
}
</style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">
        <img src="{{ asset('images/logo-ranah-rengkuh.png') }}" alt="Ranah Rengkuh">
    </div>

    <nav class="menu">
        <a href="{{ route('volunteer.dashboard') }}">
            <span>⌂</span> Dashboard
        </a>
        <a href="{{ route('volunteer.kegiatan') }}">
            <span>📅</span> Kegiatan
        </a>
        <a href="{{ route('volunteer.pembayaran') }}" class="active">
            <span>💳</span> Pembayaran
        </a>
        <a href="{{ route('volunteer.riwayat') }}">
            <span>⏰</span> Riwayat
        </a>
    </nav>

    <div class="logout-box">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <span>↪</span> Log Out
            </button>
        </form>
    </div>
</aside>

<main class="main">

    <header class="topbar">
        <div class="breadcrumb">
            <span>Pembayaran / </span> Instruksi Pembayaran
        </div>

        <div class="topbar-right">
            <span style="font-size: 16px;">🔔</span>
            <div class="user-profile">
                <span class="user-avatar">👤</span>
                <span>{{ $nama }}</span>
            </div>
        </div>
    </header>

    <div class="content">

        <h1 class="page-title">Instruksi Pembayaran</h1>
        <p class="page-subtitle">Selesaikan pembayaran sebelum batas waktu untuk mengamankan tempatmu.</p>

        @php
            $kodeBayar = 'RR-REG-' . date('Ymd', strtotime($pendaftaran->Tanggal_Pendaftaran)) . '-' . str_pad($pendaftaran->ID_Pendaftaran, 3, '0', STR_PAD_LEFT);
            $deadline = \Carbon\Carbon::parse($pendaftaran->Tanggal_Pendaftaran)->addDay()->setTime(11, 0)->translatedFormat('d F Y, H.i \W\I\B');
            $metode = $pembayaran->Metode_Pembayaran ?? 'QRIS';
            $nominal = $pembayaran->Nominal;

            // QRIS Dinamis via QRServer API
            $qrisData = '00020101021226670014ID.LINKAJA.WWW01189360091100223403560215' . $kodeBayar . '520458125303360540' . $nominal . '5802ID5912RanahRengkuh6008Semarang';
            $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' . urlencode($qrisData);
        @endphp

        <div class="payment-grid">

            <!-- CARD KIRI FIGMA -->
            <div class="payment-card">
                <div class="status-banner-pending">
                    Menunggu Pembayaran ({{ $metode }})
                </div>

                @if($metode === 'Virtual Account')
                    <div class="method-title">Virtual Account (Midtrans Gateway)</div>
                    <div class="qris-display-box">
                        <small style="color: #6a598f; font-weight: 700; text-transform: uppercase;">Nomor Rekening Virtual Account</small>
                        <div class="va-number-box" id="kodeRef">88019{{ str_pad($pendaftaran->ID_Pendaftaran, 8, '0', STR_PAD_LEFT) }}</div>
                        <small style="color: #8c80a8;">BCA / Mandiri / BRI / BNI Virtual Account</small>
                    </div>

                    <ol class="instruction-list">
                        <li>Buka aplikasi m-Banking atau ATM bank pilihanmu.</li>
                        <li>Pilih menu <strong>Transfer > Virtual Account</strong>.</li>
                        <li>Masukkan nomor Virtual Account di atas.</li>
                        <li>Pastikan nama tertera <strong>Ranah Rengkuh - {{ $nama }}</strong> dengan nominal Rp{{ number_format($nominal, 0, ',', '.') }}.</li>
                        <li>Konfirmasi transaksi untuk menyelesaikan pembayaran.</li>
                    </ol>
                @elseif($metode === 'E-Wallet')
                    <div class="method-title">E-Wallet Direct (GoPay / OVO / ShopeePay)</div>
                    <div class="qris-display-box">
                        <strong style="font-size: 16px; color: #433171; margin-bottom: 6px;">📱 Pembayaran Dompet Digital</strong>
                        <p style="margin: 0 0 10px; font-size: 12px; color: #766996;">Nomor HP Terdaftar: <strong>{{ $pendaftaran->volunteer->No_Telpon ?? '081234567890' }}</strong></p>
                        <img src="{{ $qrUrl }}" class="qris-qr-image" alt="QR E-Wallet">
                        <small style="color: #8c80a8;">Scan menggunakan aplikasi E-Wallet pilihanmu</small>
                    </div>

                    <ol class="instruction-list">
                        <li>Buka aplikasi GoPay, OVO, ShopeePay, atau DANA.</li>
                        <li>Pindai QR code di atas atau masukkan kode referensi pembayaran.</li>
                        <li>Periksa rincian pembayaran Rp{{ number_format($nominal, 0, ',', '.') }}.</li>
                        <li>Selesaikan pembayaran menggunakan saldo dompet digitalmu.</li>
                    </ol>
                @else
                    <!-- DEFAULT: QRIS RESMI SESUAI FIGMA -->
                    <div class="method-title">QRIS Dinamis</div>
                    <div class="qris-display-box">
                        <img src="{{ $qrUrl }}" class="qris-qr-image" alt="QRIS Ranah Rengkuh">
                        <strong style="font-size: 15px; color: #3b2a68;">Scan QRIS Ranah Rengkuh</strong>
                        <small style="color: #8c80a8;">Mendukung seluruh m-Banking & Dompet Digital Indonesia</small>
                    </div>

                    <ol class="instruction-list">
                        <li>Buka aplikasi bank atau dompet digital yang mendukung QRIS (BCA, Mandiri, GoPay, OVO, dll).</li>
                        <li>Pindai kode QR dinamis pembayaran di atas.</li>
                        <li>Periksa nama penerima <strong>Ranah Rengkuh</strong> dan nominal Rp{{ number_format($nominal, 0, ',', '.') }}.</li>
                        <li>Konfirmasi pembayaran untuk mengamankan slot relawanmu.</li>
                    </ol>
                @endif

                <div class="kode-box">
                    <small>Kode referensi pembayaran</small>
                    <strong id="kodeRefCopy">{{ $kodeBayar }}</strong>
                </div>

                <button class="btn-salin" onclick="salinKode()">
                    Salin Kode Pembayaran
                </button>
            </div>

            <!-- CARD KANAN FIGMA -->
            <div class="summary-card">
                <h3>{{ $pendaftaran->kegiatan->Nama_Kegiatan }}</h3>
                <div class="summary-user-meta">{{ $nama }} • {{ $kodeBayar }}</div>
                <div class="summary-date-meta">
                    📅 {{ \Carbon\Carbon::parse($pendaftaran->kegiatan->Tanggal_Kegiatan)->translatedFormat('d F Y') }} • {{ $pendaftaran->kegiatan->Lokasi ?? 'Semarang' }}
                </div>

                <div class="total-pay-box">
                    <small>Total pembayaran</small>
                    <strong>Rp{{ number_format($nominal, 0, ',', '.') }}</strong>
                </div>

                <!-- TOMBOL SIMULASI PEMBAYARAN SUKSES MIDTRANS -->
                <form method="POST" action="{{ route('volunteer.pembayaran.simulasi.sukses', $pembayaran->ID_Pembayaran) }}">
                    @csrf
                    <button type="submit" class="btn-simulasi-bayar">
                        ⚡ Bayar Sukses (Simulasi Midtrans)
                    </button>
                </form>

                <form method="POST" action="{{ route('volunteer.pembayaran.konfirmasi', $pembayaran->ID_Pembayaran) }}">
                    @csrf
                    <input type="hidden" name="metode" value="{{ $metode }}">
                    <button type="submit" class="btn-cek-status">
                        Cek Status Pembayaran
                    </button>
                </form>

                <a href="{{ route('volunteer.pembayaran.metode', $pembayaran->ID_Pembayaran) }}" class="btn-kembali-secondary">
                    Ganti Metode Pembayaran
                </a>

                <div class="simulasi-banner">
                    💡 <strong>Mode Simulasi Midtrans:</strong><br>
                    Kamu bisa klik tombol hijau <em>"Bayar Sukses"</em> di atas untuk langsung menguji flow pembayaran berhasil & melihat struk bukti lunasnya!
                </div>
            </div>

        </div>

    </div>
</main>

<script>
function salinKode() {
    const el = document.getElementById('kodeRef') || document.getElementById('kodeRefCopy');
    const kode = el.innerText;
    navigator.clipboard.writeText(kode).then(() => {
        alert('Kode / Nomor ' + kode + ' berhasil disalin ke clipboard!');
    });
}
</script>

</body>
</html>
