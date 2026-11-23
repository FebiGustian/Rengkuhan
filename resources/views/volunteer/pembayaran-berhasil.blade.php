<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pembayaran Berhasil | Ranah Rengkuh</title>

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

.content { padding: 32px 32px 60px; }
.page-title { font-size: 26px; font-weight: 800; color: #3b2a68; margin: 0 0 6px; }
.page-subtitle { font-size: 13px; color: #6a5c8e; margin: 0 0 28px; }

/* KARTU SUKSES FIGMA TENGAH */
.success-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 20px;
    padding: 40px 48px;
    max-width: 680px;
    box-shadow: 0 6px 24px rgba(60, 45, 110, 0.06);
    margin: 0 auto;
    text-align: center;
}

.success-icon-box {
    width: 64px;
    height: 64px;
    background: #e2f7ec;
    color: #17834a;
    border-radius: 50%;
    display: grid;
    place-items: center;
    font-size: 28px;
    font-weight: 800;
    margin: 0 auto 18px;
}

.success-header-text {
    font-size: 18px;
    font-weight: 800;
    color: #17834a;
    margin-bottom: 8px;
}

.success-desc {
    font-size: 13px;
    color: #6a5b8f;
    line-height: 1.5;
    max-width: 480px;
    margin: 0 auto 26px;
}

/* TOTAL DIBAYAR BOX FIGMA */
.total-paid-box {
    background: #f8f6fd;
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 24px;
}

.total-paid-box small {
    display: block;
    font-size: 11px;
    color: #8375a0;
    margin-bottom: 4px;
}

.total-paid-box strong {
    font-size: 32px;
    font-weight: 800;
    color: #3b2a68;
}

/* META DATA TRANSAKSI FIGMA */
.receipt-table {
    width: 100%;
    margin-bottom: 30px;
    font-size: 13px;
    text-align: left;
}

.receipt-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f6f3fc;
}

.receipt-row span { color: #8578a2; }
.receipt-row strong { color: #3b2a68; }

/* 2 BUTTONS FIGMA */
.btn-action-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.btn-secondary-receipt {
    padding: 13px 20px;
    border-radius: 12px;
    border: 1px solid #dcd3ee;
    background: #ffffff;
    color: #55447a;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: background .2s;
}

.btn-secondary-receipt:hover {
    background: #f8f6fd;
}

.btn-primary-receipt {
    padding: 13px 20px;
    border-radius: 12px;
    border: none;
    background: #5d4692;
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(93, 70, 146, 0.25);
    transition: background .2s;
}

.btn-primary-receipt:hover {
    background: #4a3678;
}

@media(max-width: 900px) {
    .sidebar { position: relative; width: 100%; }
    .main { margin-left: 0; }
    .btn-action-group { grid-template-columns: 1fr; }
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
            <span>Pembayaran / </span> Pembayaran Berhasil
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

        <h1 class="page-title">Pembayaran Berhasil</h1>
        <p class="page-subtitle">Pendaftaranmu telah dikonfirmasi. Sampai bertemu di kegiatan!</p>

        @php
            $regNo = 'RR-TXN-' . date('Ymd', strtotime($pendaftaran->Tanggal_Pendaftaran)) . '-' . str_pad($pendaftaran->ID_Pendaftaran, 3, '0', STR_PAD_LEFT);
            $waktuBayar = now()->translatedFormat('d F Y, H.i \W\I\B');
        @endphp

        <!-- KARTU SUKSES FIGMA -->
        <div class="success-card">
            <div class="success-icon-box">✓</div>

            <div class="success-header-text">Pembayaran Berhasil</div>
            <p class="success-desc">
                Terima kasih, {{ $nama }}! Pembayaran Rp{{ number_format($pembayaran->Nominal, 0, ',', '.') }} telah diterima dan tempatmu sudah dikonfirmasi.
            </p>

            <div class="total-paid-box">
                <small>Total dibayar</small>
                <strong>Rp{{ number_format($pembayaran->Nominal, 0, ',', '.') }}</strong>
            </div>

            <div class="receipt-table">
                <div class="receipt-row">
                    <span>Nomor transaksi</span>
                    <strong>{{ $regNo }}</strong>
                </div>
                <div class="receipt-row">
                    <span>Nama volunteer</span>
                    <strong>{{ $pendaftaran->volunteer->Nama ?? $nama }}</strong>
                </div>
                <div class="receipt-row">
                    <span>Nama kegiatan</span>
                    <strong>{{ $pendaftaran->kegiatan->Nama_Kegiatan }}</strong>
                </div>
                <div class="receipt-row">
                    <span>Tanggal pembayaran</span>
                    <strong>{{ $waktuBayar }}</strong>
                </div>
                <div class="receipt-row">
                    <span>Metode pembayaran</span>
                    <strong>{{ $pembayaran->Metode_Pembayaran ?? 'QRIS' }}</strong>
                </div>
            </div>

            <div class="btn-action-group">
                <a href="{{ route('volunteer.kegiatan.detail', $pendaftaran->ID_Kegiatan) }}" class="btn-secondary-receipt">
                    Lihat Detail Pendaftaran
                </a>
                <a href="{{ route('volunteer.dashboard') }}#kegiatan-saya" class="btn-primary-receipt">
                    Lihat Riwayat Kegiatan
                </a>
            </div>
        </div>

    </div>
</main>

</body>
</html>
