<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pembayaran | Ranah Rengkuh</title>

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

/* 2 KOLOM GRID FIGMA */
.pay-layout-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.8fr) minmax(320px, 1fr);
    gap: 24px;
    align-items: start;
}

/* KIRI: RINGKASAN PENDAFTARAN & METODE */
.card-box {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.04);
    margin-bottom: 22px;
}

.card-box h3 {
    margin: 0 0 16px;
    font-size: 16px;
    font-weight: 700;
    color: #3b2a68;
}

.kegiatan-header-name {
    font-size: 19px;
    font-weight: 800;
    color: #3b2a68;
    margin-bottom: 4px;
}

.kegiatan-sub-meta {
    font-size: 12px;
    color: #8c80a8;
    margin-bottom: 18px;
}

.reg-row {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    padding: 8px 0;
    border-top: 1px solid #f6f3fc;
}

.reg-row span { color: #8578a2; }
.reg-row strong { color: #3b2a68; }

/* METODE ITEM FIGMA RADIO */
.metode-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 16px 18px;
    border: 1px solid #e2daf0;
    border-radius: 12px;
    margin-bottom: 12px;
    cursor: pointer;
    transition: all .2s;
    background: #faf9fe;
}

.metode-item:hover, .metode-item.selected {
    border-color: #5d4692;
    background: #f7f3fd;
    box-shadow: 0 2px 10px rgba(93, 70, 146, 0.08);
}

.metode-item input[type="radio"] {
    margin-top: 3px;
    accent-color: #5d4692;
    width: 17px;
    height: 17px;
}

.metode-info strong {
    display: block;
    font-size: 14px;
    color: #3b2a68;
    margin-bottom: 2px;
}

.metode-info small {
    font-size: 12px;
    color: #8578a2;
}

/* KANAN: RINGKASAN BIAYA FIGMA */
.cost-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.04);
}

.cost-card h3 {
    margin: 0 0 16px;
    font-size: 16px;
    font-weight: 700;
    color: #3b2a68;
}

.cost-row {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    margin-bottom: 8px;
}

.cost-row span { color: #8578a2; }
.cost-row strong { color: #3b2a68; }

.total-cost-box {
    background: #f8f6fd;
    border-radius: 12px;
    padding: 16px 20px;
    margin: 18px 0;
}

.total-cost-box small {
    display: block;
    font-size: 11px;
    color: #7d6f99;
    margin-bottom: 4px;
}

.total-cost-box strong {
    font-size: 26px;
    font-weight: 800;
    color: #3b2a68;
}

.metode-pilihan-note {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #55447a;
    font-weight: 600;
    margin-bottom: 16px;
}

.btn-bayar-sekarang {
    width: 100%;
    padding: 14px;
    background: #5d4692;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(93, 70, 146, 0.25);
    transition: background .2s;
    text-align: center;
    margin-bottom: 10px;
}

.btn-bayar-sekarang:hover { background: #4b367d; }

.btn-kembali-link {
    display: block;
    width: 100%;
    padding: 12px;
    background: #ffffff;
    border: 1px solid #dcd3ee;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700;
    color: #55447a;
    text-decoration: none;
    text-align: center;
    margin-bottom: 14px;
}

.footnote-pay {
    font-size: 11px;
    color: #8c80a8;
    line-height: 1.5;
    text-align: center;
}

@media(max-width: 900px) {
    .pay-layout-grid { grid-template-columns: 1fr; }
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
            <span>Pembayaran / </span> Pembayaran
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

        <h1 class="page-title">Pembayaran</h1>
        <p class="page-subtitle">Pilih metode pembayaran untuk menyelesaikan pendaftaran kegiatanmu.</p>

        @php
            $regNo = 'RR-REG-' . date('Ymd', strtotime($pendaftaran->Tanggal_Pendaftaran)) . '-' . str_pad($pendaftaran->ID_Pendaftaran, 3, '0', STR_PAD_LEFT);
        @endphp

        <form method="POST" action="{{ route('volunteer.pembayaran.proses', $pembayaran->ID_Pembayaran) }}" id="formPembayaran">
            @csrf

            <div class="pay-layout-grid">

                <!-- KIRI FIGMA -->
                <div class="left-col">

                    <!-- RINGKASAN PENDAFTARAN -->
                    <div class="card-box">
                        <h3>Ringkasan pendaftaran</h3>

                        <div class="kegiatan-header-name">{{ $pendaftaran->kegiatan->Nama_Kegiatan }}</div>
                        <div class="kegiatan-sub-meta">
                            {{ $pendaftaran->kegiatan->Kategori ?? 'Pendidikan' }} • {{ \Carbon\Carbon::parse($pendaftaran->kegiatan->Tanggal_Kegiatan)->translatedFormat('d F Y') }} • {{ $pendaftaran->kegiatan->Lokasi ?? 'Semarang' }}
                        </div>

                        <div class="reg-row">
                            <span>Nomor pendaftaran</span>
                            <strong>{{ $regNo }}</strong>
                        </div>
                        <div class="reg-row">
                            <span>Nama volunteer</span>
                            <strong>{{ $pendaftaran->volunteer->Nama ?? $nama }}</strong>
                        </div>
                        <div class="reg-row">
                            <span>Email</span>
                            <strong>{{ $pendaftaran->volunteer->Email ?? '-' }}</strong>
                        </div>
                    </div>

                    <!-- METODE PEMBAYARAN FIGMA (MIDTRANS SIMULATOR) -->
                    <div class="card-box">
                        <h3>Metode pembayaran (Simulasi Payment Gateway)</h3>

                        <label class="metode-item selected" onclick="updateMetode('QRIS')">
                            <input type="radio" name="metode" value="QRIS" checked>
                            <div class="metode-info">
                                <strong>QRIS (GoPay, OVO, ShopeePay, Dana, BCA Mobile)</strong>
                                <small>Pindai kode QR dinamis dengan aplikasi pembayaranmu</small>
                            </div>
                        </label>

                        <label class="metode-item" onclick="updateMetode('Virtual Account')">
                            <input type="radio" name="metode" value="Virtual Account">
                            <div class="metode-info">
                                <strong>Virtual Account (BCA, Mandiri, BRI, BNI)</strong>
                                <small>Transfer instan melalui nomor rekening virtual Midtrans</small>
                            </div>
                        </label>

                        <label class="metode-item" onclick="updateMetode('E-Wallet')">
                            <input type="radio" name="metode" value="E-Wallet">
                            <div class="metode-info">
                                <strong>E-Wallet Direct</strong>
                                <small>Bayar menggunakan saldo dompet digital langsung</small>
                            </div>
                        </label>
                    </div>

                </div>

                <!-- KANAN FIGMA -->
                <div class="right-col">

                    <div class="cost-card">
                        <h3>Ringkasan biaya</h3>

                        <div class="cost-row">
                            <span>Biaya pendaftaran</span>
                            <strong>Rp{{ number_format($pembayaran->Nominal, 0, ',', '.') }}</strong>
                        </div>

                        <div class="cost-row">
                            <span>Biaya layanan</span>
                            <strong>Rp0</strong>
                        </div>

                        <div class="total-cost-box">
                            <small>Total pembayaran</small>
                            <strong>Rp{{ number_format($pembayaran->Nominal, 0, ',', '.') }}</strong>
                        </div>

                        <div class="metode-pilihan-note">
                            <span>Metode terpilih:</span>
                            <strong id="labelMetodeTerpilih" style="color: #5d4692;">QRIS</strong>
                        </div>

                        <button type="submit" class="btn-bayar-sekarang">
                            Bayar Sekarang →
                        </button>

                        <a href="{{ route('volunteer.kegiatan.detail', $pendaftaran->ID_Kegiatan) }}" class="btn-kembali-link">
                            Kembali
                        </a>

                        <div class="footnote-pay">
                            Pendaftaran dikonfirmasi setelah pembayaran berhasil.<br>
                            Simulasi pembayaran instan sandbox aktif.
                        </div>
                    </div>

                </div>

            </div>

        </form>

    </div>
</main>

<script>
function updateMetode(nama) {
    document.getElementById('labelMetodeTerpilih').innerText = nama;
    document.querySelectorAll('.metode-item').forEach(el => el.classList.remove('selected'));
    event.currentTarget.classList.add('selected');
}
</script>

</body>
</html>
