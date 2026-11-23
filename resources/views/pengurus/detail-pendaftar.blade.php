<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Pendaftar | Ranah Rengkuh</title>

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
.brand { padding: 0 8px 8px; }
.brand img { width: 140px; max-height: 60px; object-fit: contain; }
.brand-label { display: block; font-size: 9px; font-weight: 800; letter-spacing: 1.5px; color: #55447a; margin: 6px 0 16px; text-transform: uppercase; }
.menu { display: flex; flex-direction: column; gap: 6px; }
.menu a { display: flex; align-items: center; gap: 12px; padding: 11px 14px; border-radius: 10px; color: #55447a; text-decoration: none; font-size: 13px; font-weight: 600; transition: all .2s; }
.menu a:hover, .menu a.active { background: #5d4692; color: white; }
.logout-box { margin-top: auto; padding-top: 20px; }
.logout-box button { width: 100%; border: none; background: transparent; color: #55447a; display: flex; align-items: center; gap: 12px; padding: 11px 14px; font-size: 13px; font-weight: 600; cursor: pointer; border-radius: 10px; }
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
.detail-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.8fr) minmax(320px, 1fr);
    gap: 24px;
    align-items: start;
}

/* CARD KIRI FIGMA */
.data-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.04);
}

.data-card h3 {
    margin: 0 0 20px;
    font-size: 16px;
    font-weight: 700;
    color: #3b2a68;
}

.data-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f6f3fc;
    font-size: 13px;
}

.data-row span { color: #7f739c; }
.data-row strong { color: #3b2a68; }

.data-block {
    margin-top: 18px;
}

.data-block label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #4b387e;
    margin-bottom: 6px;
}

.data-block p {
    margin: 0;
    font-size: 13px;
    color: #55447a;
    line-height: 1.5;
    background: #fbf9ff;
    padding: 12px 14px;
    border-radius: 9px;
    border: 1px solid #eee8f8;
}

.btn-kembali {
    display: inline-block;
    margin-top: 24px;
    padding: 10px 20px;
    border-radius: 10px;
    border: 1px solid #dcd3ee;
    background: #ffffff;
    color: #55447a;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
}

/* CARD KANAN FIGMA */
.side-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.04);
}

.side-thumb {
    width: 100%;
    height: 150px;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 14px;
    background: #3b2a68;
}

.side-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.side-kategori {
    font-size: 11px;
    color: #8c80a8;
    margin-bottom: 4px;
}

.side-title {
    font-size: 16px;
    font-weight: 700;
    color: #3b2a68;
    margin-bottom: 12px;
}

.side-meta {
    font-size: 12px;
    color: #7b6f98;
    margin-bottom: 4px;
}

.side-price {
    font-size: 14px;
    font-weight: 700;
    color: #3b2a68;
    margin: 14px 0 16px;
}

.btn-lihat-pembayaran {
    display: block;
    width: 100%;
    padding: 12px;
    background: #5d4692;
    color: #ffffff;
    border-radius: 10px;
    text-align: center;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
}

@media(max-width: 900px) {
    .detail-grid { grid-template-columns: 1fr; }
    .sidebar { position: relative; width: 100%; }
    .main { margin-left: 0; }
}
</style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">
        <img src="{{ asset('images/logo-ranah-rengkuh.png') }}" alt="Ranah Rengkuh">
        <span class="brand-label">MANAJEMEN · MANDALA</span>
    </div>

    <nav class="menu">
        <a href="{{ route('pengurus.dashboard') }}">
            <span>⌂</span> Dashboard
        </a>
        <a href="{{ route('pengurus.kegiatan.index') }}">
            <span>📅</span> Kelola Kegiatan
        </a>
        <a href="{{ route('pengurus.volunteer.index') }}">
            <span>👥</span> Kelola Volunteer
        </a>
        <a href="{{ route('pengurus.laporan.pendaftar') }}" class="active">
            <span>📋</span> Laporan Pendaftar
        </a>
        <a href="{{ route('pengurus.rekap.pembayaran') }}">
            <span>💳</span> Rekap Pembayaran
        </a>
        <a href="{{ route('pengurus.generate.rab.ai') }}">
            <span>✨</span> Generate RAB dengan AI
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
            <span>Manajemen / </span> Detail Pendaftar
        </div>

        <div class="topbar-right">
            <span style="font-size: 16px;">🔔</span>
            <div class="user-profile">
                <span class="user-avatar">👤</span>
                <span>{{ strtoupper($nama) }}</span>
            </div>
        </div>
    </header>

    <div class="content">

        <h1 class="page-title">Detail Pendaftar</h1>
        <p class="page-subtitle">Informasi volunteer dan kegiatan pada pendaftaran yang dipilih.</p>

        @php
            $bayar = $pendaftaran->pembayaran->first();
            $status = $bayar ? $bayar->Status : 'Menunggu pembayaran';
            $regNo = 'RR-REG-' . date('Ymd', strtotime($pendaftaran->Tanggal_Pendaftaran)) . '-' . str_pad($pendaftaran->ID_Pendaftaran, 3, '0', STR_PAD_LEFT);
        @endphp

        <div class="detail-grid">

            <div class="data-card">
                <h3>Data volunteer</h3>

                <div class="data-row">
                    <span>Nomor pendaftaran</span>
                    <strong>{{ $regNo }}</strong>
                </div>
                <div class="data-row">
                    <span>Nama</span>
                    <strong>{{ $pendaftaran->volunteer->Nama ?? '-' }}</strong>
                </div>
                <div class="data-row">
                    <span>Email</span>
                    <strong>{{ $pendaftaran->volunteer->Email ?? '-' }}</strong>
                </div>
                <div class="data-row">
                    <span>Nomor telepon</span>
                    <strong>{{ $pendaftaran->volunteer->No_Telpon ?? '-' }}</strong>
                </div>
                <div class="data-row">
                    <span>Tanggal pendaftaran</span>
                    <strong>{{ \Carbon\Carbon::parse($pendaftaran->Tanggal_Pendaftaran)->translatedFormat('d F Y') }}</strong>
                </div>
                <div class="data-row">
                    <span>Status pendaftaran</span>
                    <strong>{{ $status }}</strong>
                </div>

                <div class="data-block">
                    <label>Motivasi mengikuti kegiatan</label>
                    <p>{{ $pendaftaran->Motivasi ?? 'Ingin berbagi ilmu dan membantu adik-adik belajar dengan lebih percaya diri.' }}</p>
                </div>

                <div class="data-block">
                    <label>Pengalaman volunteer</label>
                    <p>{{ $pendaftaran->Pengalaman ?? 'Belum ada pengalaman volunteer.' }}</p>
                </div>

                <a href="{{ route('pengurus.laporan.pendaftar') }}" class="btn-kembali">Kembali</a>
            </div>

            <div class="side-card">
                <div class="side-thumb">
                    @php
                        $thumb = $pendaftaran->kegiatan->Foto_Kegiatan 
                            ? asset('storage/' . $pendaftaran->kegiatan->Foto_Kegiatan)
                            : 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=800&auto=format&fit=crop';
                    @endphp
                    <img src="{{ $thumb }}" alt="{{ $pendaftaran->kegiatan->Nama_Kegiatan }}">
                </div>

                <div class="side-kategori">{{ $pendaftaran->kegiatan->Kategori ?? 'Pendidikan' }}</div>
                <div class="side-title">{{ $pendaftaran->kegiatan->Nama_Kegiatan }}</div>

                <div class="side-meta">📅 {{ \Carbon\Carbon::parse($pendaftaran->kegiatan->Tanggal_Kegiatan)->translatedFormat('d F Y') }} • {{ $pendaftaran->kegiatan->Lokasi ?? 'Semarang' }}</div>
                <div class="side-meta">👥 Kuota {{ $pendaftaran->kegiatan->Kuota }} orang • {{ $pendaftaran->kegiatan->pendaftaran->count() }} pendaftar</div>

                <div class="side-price">Biaya pendaftaran Rp{{ number_format($pendaftaran->kegiatan->Biaya ?? 50000, 0, ',', '.') }}</div>

                <a href="{{ route('pengurus.rekap.pembayaran') }}" class="btn-lihat-pembayaran">
                    Lihat Rekap Pembayaran
                </a>
            </div>

        </div>

    </div>
</main>

</body>
</html>
