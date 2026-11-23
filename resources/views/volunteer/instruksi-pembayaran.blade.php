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
.sidebar {
    position: fixed;
    inset: 0 auto 0 0;
    width: 220px;
    background: #ded7f4;
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
    z-index: 10;
}

.brand { padding: 0 8px 24px; }
.brand img { width: 140px; max-height: 60px; object-fit: contain; }

.menu {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-top: 10px;
}

.menu a {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 14px;
    border-radius: 10px;
    color: #55447a;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all .2s;
}

.menu a:hover,
.menu a.active {
    background: #5d4692;
    color: white;
}

.logout-box {
    margin-top: auto;
    padding-top: 20px;
}

.logout-box button {
    width: 100%;
    border: none;
    background: transparent;
    color: #55447a;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    border-radius: 10px;
}

.logout-box button:hover { background: rgba(93, 70, 146, 0.12); }

/* MAIN */
.main {
    margin-left: 220px;
    min-height: 100vh;
}

.topbar {
    height: 58px;
    background: #7bbcf5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 32px;
    color: #2e2154;
    font-size: 13px;
    font-weight: 600;
}

.breadcrumb { color: #2b1d56; }
.breadcrumb span { opacity: 0.7; }

.topbar-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 700;
}

.user-avatar {
    width: 30px;
    height: 30px;
    background: #ffffff;
    border-radius: 50%;
    display: grid;
    place-items: center;
    font-size: 13px;
    color: #5d4692;
}

.content {
    padding: 28px 32px 50px;
}

.page-title {
    font-size: 26px;
    font-weight: 800;
    color: #3b2a68;
    margin: 0 0 6px;
}

.page-subtitle {
    font-size: 13px;
    color: #6a5c8e;
    margin: 0 0 24px;
}

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

.qris-title {
    font-size: 16px;
    font-weight: 800;
    color: #3b2a68;
    margin-bottom: 14px;
}

.qris-box {
    width: 200px;
    height: 200px;
    border: 2px dashed #9d8bc9;
    border-radius: 14px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 16px;
    margin-bottom: 20px;
    background: #faf8fe;
}

.qris-box strong {
    font-size: 15px;
    color: #4b387e;
    margin-bottom: 4px;
}

.qris-box small {
    font-size: 11px;
    color: #8c80a8;
}

.instruction-list {
    margin: 0 0 24px;
    padding-left: 20px;
    font-size: 13px;
    color: #55447a;
    line-height: 1.8;
}

/* KODE PEMBAYARAN BOX */
.kode-box {
    background: #f8f6fd;
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 14px;
}

.kode-box small {
    display: block;
    font-size: 11px;
    color: #887b9e;
    margin-bottom: 4px;
}

.kode-box strong {
    font-size: 20px;
    font-weight: 800;
    color: #3b2a68;
    letter-spacing: 1px;
}

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
}

.btn-salin:hover {
    background: #f6f3fc;
}

/* CARD KANAN FIGMA */
.summary-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.05);
}

.summary-card h3 {
    margin: 0 0 8px;
    font-size: 17px;
    font-weight: 800;
    color: #3b2a68;
}

.summary-user-meta {
    font-size: 12px;
    color: #7b6f98;
    margin-bottom: 6px;
}

.summary-date-meta {
    font-size: 12px;
    color: #8f84aa;
    margin-bottom: 20px;
}

.total-pay-box {
    background: #f8f6fd;
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 18px;
}

.total-pay-box small {
    display: block;
    font-size: 11px;
    color: #7e719c;
    margin-bottom: 4px;
}

.total-pay-box strong {
    font-size: 26px;
    font-weight: 800;
    color: #3b2a68;
}

.deadline-meta {
    font-size: 11px;
    color: #7e719c;
    margin-bottom: 4px;
}

.deadline-time {
    font-size: 13px;
    font-weight: 700;
    color: #3b2a68;
    margin-bottom: 22px;
}

.btn-cek-status {
    width: 100%;
    padding: 14px;
    background: #5d4692;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    margin-bottom: 10px;
    transition: background .2s;
    text-align: center;
    text-decoration: none;
    display: block;
}

.btn-cek-status:hover {
    background: #4a3678;
}

.btn-kembali-secondary {
    width: 100%;
    padding: 12px;
    background: #ffffff;
    border: 1px solid #d4c9ea;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
    color: #55447a;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    display: block;
    margin-bottom: 14px;
}

.btn-kembali-secondary:hover {
    background: #f7f4fc;
}

.simulasi-note {
    font-size: 11px;
    color: #9287ae;
    text-align: center;
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

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 12px 18px; border-radius: 9px; margin-bottom: 16px; font-size: 13px;">
                ✓ {{ session('success') }}
            </div>
        @endif

        @php
            $kodeBayar = 'RR-REG-' . date('Ymd', strtotime($pendaftaran->Tanggal_Pendaftaran)) . '-' . str_pad($pendaftaran->ID_Pendaftaran, 3, '0', STR_PAD_LEFT);
            $deadline = \Carbon\Carbon::parse($pendaftaran->Tanggal_Pendaftaran)->addDay()->setTime(11, 0)->translatedFormat('d F Y, H.i \W\I\B');
        @endphp

        <div class="payment-grid">

            <!-- CARD KIRI FIGMA -->
            <div class="payment-card">
                <div class="status-banner-pending">
                    @if($pembayaran->Status === 'Lunas')
                        <span style="color: #155724;">✓ Pembayaran Berhasil & Telah Diterima</span>
                    @elseif($pembayaran->Status === 'Menunggu Verifikasi')
                        <span style="color: #0c5460;">⏳ Sedang Diverifikasi oleh Pengurus</span>
                    @else
                        Menunggu Pembayaran
                    @endif
                </div>

                <div class="qris-title">QRIS / Pembayaran Digital</div>

                <div class="qris-box">
                    <strong>Area QRIS</strong>
                    <small>Scan QRIS Ranah Rengkuh<br>(BCA / Mandiri / GoPay / OVO)</small>
                </div>

                <ol class="instruction-list">
                    <li>Buka aplikasi bank atau dompet digital yang mendukung QRIS.</li>
                    <li>Pindai kode QR pembayaran yang tersedia.</li>
                    <li>Periksa nama penerima dan nominal Rp{{ number_format($pembayaran->Nominal, 0, ',', '.') }}.</li>
                    <li>Konfirmasi pembayaran, lalu cek status pembayaran kamu.</li>
                </ol>

                <div class="kode-box">
                    <small>Kode / referensi pembayaran</small>
                    <strong id="kodeRef">{{ $kodeBayar }}</strong>
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
                    <strong>Rp{{ number_format($pembayaran->Nominal, 0, ',', '.') }}</strong>
                </div>

                <div class="deadline-meta">Batas waktu pembayaran</div>
                <div class="deadline-time">{{ $deadline }}</div>

                <form method="POST" action="{{ route('volunteer.pembayaran.konfirmasi', $pembayaran->ID_Pembayaran) }}">
                    @csrf
                    <input type="hidden" name="metode" value="QRIS">
                    <button type="submit" class="btn-cek-status">
                        Cek Status Pembayaran
                    </button>
                </form>

                <a href="{{ route('volunteer.dashboard') }}" class="btn-kembali-secondary">
                    Kembali ke Dashboard
                </a>

                <div class="simulasi-note">
                    Contoh pembayaran untuk simulasi kerelawanan Ranah Rengkuh.
                </div>
            </div>

        </div>

    </div>
</main>

<script>
function salinKode() {
    const kode = document.getElementById('kodeRef').innerText;
    navigator.clipboard.writeText(kode).then(() => {
        alert('Kode pembayaran ' + kode + ' berhasil disalin!');
    });
}
</script>

</body>
</html>
