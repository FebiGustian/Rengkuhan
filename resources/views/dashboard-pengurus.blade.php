<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Manajemen | Ranah Rengkuh</title>

<style>
* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
    background: #eaf3ff;
    color: #3b2f66;
}

/* SIDEBAR FIGMA PENGURUS */
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

.brand {
    padding: 0 8px 8px;
    text-align: left;
}

.brand img {
    width: 140px;
    max-height: 60px;
    object-fit: contain;
}

.brand-label {
    display: block;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1.5px;
    color: #55447a;
    margin: 6px 0 16px;
    text-transform: uppercase;
}

.menu {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.menu a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    border-radius: 10px;
    color: #55447a;
    text-decoration: none;
    font-size: 13px;
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
    padding: 11px 14px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    border-radius: 10px;
}

.logout-box button:hover { background: rgba(93, 70, 146, 0.12); }

/* MAIN CONTENT */
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
    padding: 24px 32px 50px;
}

.page-title {
    font-size: 26px;
    font-weight: 800;
    color: #3b2a68;
    margin: 0 0 16px;
}

/* BANNER MANDALA FIGMA */
.hero-banner {
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    padding: 26px 32px;
    background: linear-gradient(135deg, #cde3fa 0%, #a4d2fb 60%, #e2d2f7 100%);
    box-shadow: 0 4px 18px rgba(90, 130, 200, 0.12);
    margin-bottom: 22px;
}

.hero-banner h1 {
    margin: 0 0 8px;
    font-size: 26px;
    font-weight: 800;
    color: #3e2e71;
}

.hero-banner p {
    margin: 0;
    font-size: 13px;
    color: #55447a;
    max-width: 520px;
    line-height: 1.5;
}

.hero-banner-art {
    position: absolute;
    right: 28px;
    bottom: 10px;
    font-size: 55px;
    opacity: 0.85;
}

/* STATS 4 KOTAK FIGMA */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 22px;
}

.stat-box {
    border-radius: 14px;
    padding: 18px 20px;
    box-shadow: 0 2px 10px rgba(60, 45, 110, 0.04);
}

.stat-box.one { background: #e8dffc; }
.stat-box.two { background: #d7ecff; }
.stat-box.three { background: #fff1d4; }
.stat-box.four { background: #ede8f8; }

.stat-label {
    font-size: 11px;
    font-weight: 600;
    color: #6a5a8e;
    margin-bottom: 8px;
}

.stat-num {
    font-size: 26px;
    font-weight: 800;
    color: #3b2a68;
    margin-bottom: 4px;
}

.stat-sub {
    font-size: 11px;
    color: #7d6f9a;
}

/* 2 KOLOM GRID FIGMA */
.dashboard-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.8fr) minmax(320px, 1fr);
    gap: 22px;
}

.card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.04);
    margin-bottom: 22px;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.card-header h3 {
    margin: 0;
    font-size: 15px;
    font-weight: 700;
    color: #3b2a68;
}

.card-header a {
    font-size: 12px;
    font-weight: 600;
    color: #5d4692;
    text-decoration: none;
}

/* TABLE PENDAFTARAN TERBARU FIGMA */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
}

td {
    padding: 12px 10px;
    border-bottom: 1px solid #f4f0fb;
    color: #4b3d73;
}

tr:hover td {
    background: #faf8fe;
}

.status-badge {
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
}

.status-terdaftar { background: #e2f7ec; color: #17834a; }
.status-menunggu { background: #fff4d9; color: #925c04; }

/* KARTU KEGIATAN AKAN DATANG KANAN FIGMA */
.coming-kegiatan-box {
    display: flex;
    gap: 12px;
    margin-bottom: 12px;
}

.coming-thumb {
    width: 75px;
    height: 75px;
    border-radius: 10px;
    overflow: hidden;
    background: #3b2a68;
    flex-shrink: 0;
}

.coming-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.coming-info strong {
    display: block;
    font-size: 14px;
    color: #3b2a68;
    margin-bottom: 4px;
}

.coming-info small {
    display: block;
    font-size: 11px;
    color: #7b6f98;
    margin-bottom: 2px;
}

.coming-meta {
    font-size: 11px;
    color: #8b7fa8;
    margin-bottom: 8px;
}

/* RINGKASAN PEMBAYARAN KIRI BAWAH FIGMA */
.pembayaran-summary-grid {
    display: flex;
    justify-content: space-between;
    margin-bottom: 14px;
}

.pembayaran-summary-grid strong {
    font-size: 22px;
    font-weight: 800;
    color: #3b2a68;
    display: block;
    margin-bottom: 4px;
}

.pembayaran-summary-grid span {
    font-size: 12px;
    font-weight: 600;
    color: #55447a;
}

.pembayaran-progress-bg {
    width: 100%;
    height: 8px;
    background: #ebe4f7;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 12px;
}

.pembayaran-progress-fill {
    height: 100%;
    background: #5d4692;
    border-radius: 10px;
}

/* INFORMASI PENTING KANAN BAWAH FIGMA */
.info-penting-box {
    background: #f1edfb;
    border-radius: 14px;
    padding: 18px 20px;
    border: 1px solid #e3daf5;
}

.info-penting-box h4 {
    margin: 0 0 8px;
    font-size: 14px;
    font-weight: 700;
    color: #4b367d;
}

.info-penting-box p {
    margin: 0;
    font-size: 12px;
    line-height: 1.55;
    color: #6c5d8e;
}

@media(max-width: 900px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .dashboard-grid { grid-template-columns: 1fr; }
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
        <a href="{{ route('pengurus.dashboard') }}" class="active">
            <span>⌂</span> Dashboard
        </a>
        <a href="{{ route('pengurus.kegiatan.index') }}">
            <span>📅</span> Kelola Kegiatan
        </a>
        <a href="{{ route('pengurus.volunteer.index') }}">
            <span>👥</span> Kelola Volunteer
        </a>
        <a href="{{ route('pengurus.laporan.pendaftar') }}">
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
            <span>Manajemen / </span> Dashboard Manajemen
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

        <h1 class="page-title">Dashboard Manajemen</h1>

        <!-- HERO BANNER MANDALA FIGMA -->
        <div class="hero-banner">
            <h1>Halo, {{ $nama }}! 👋</h1>
            <p>Selamat datang kembali. Kelola kegiatan, dukung volunteer, dan pantau kontribusi kebaikan dalam satu tempat.</p>
            <div class="hero-banner-art">🎒 🧑🏻‍🤝‍🧑🏼</div>
        </div>

        <!-- STATS 4 KOTAK FIGMA -->
        <div class="stats-grid">
            <div class="stat-box one">
                <div class="stat-label">Jumlah kegiatan</div>
                <div class="stat-num">{{ $totalKegiatan }}</div>
                <div class="stat-sub">Seluruh kegiatan terkelola</div>
            </div>

            <div class="stat-box two">
                <div class="stat-label">Jumlah volunteer</div>
                <div class="stat-num">{{ $totalVolunteer }}</div>
                <div class="stat-sub">Volunteer terdaftar</div>
            </div>

            <div class="stat-box three">
                <div class="stat-label">Jumlah pendaftaran</div>
                <div class="stat-num">{{ $totalPendaftaran }}</div>
                <div class="stat-sub">Seluruh kegiatan</div>
            </div>

            <div class="stat-box four">
                <div class="stat-label">Penerimaan pembayaran</div>
                <div class="stat-num">Rp{{ number_format($sudahDiterima, 0, ',', '.') }}</div>
                <div class="stat-sub">{{ $pembayaranBerhasilCount }} berhasil · {{ $pembayaranMenungguCount }} menunggu</div>
            </div>
        </div>

        <!-- 2 KOLOM GRID FIGMA -->
        <div class="dashboard-grid">

            <!-- KOLOM KIRI FIGMA -->
            <div class="left-col">

                <!-- PENDAFTARAN TERBARU -->
                <div class="card">
                    <div class="card-header">
                        <h3>Pendaftaran terbaru</h3>
                        <a href="{{ route('pengurus.laporan.pendaftar') }}">Lihat Laporan →</a>
                    </div>

                    @if($pendaftaranTerbaru->isEmpty())
                        <div style="text-align: center; padding: 20px; color: #8a7fa5; font-size: 12px;">
                            Belum ada pendaftaran volunteer yang masuk.
                        </div>
                    @else
                        <table>
                            <tbody>
                                @foreach($pendaftaranTerbaru as $p)
                                    @php
                                        $status = $p->pembayaran->first()->Status ?? 'Menunggu';
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $p->volunteer->Nama ?? '-' }}</strong></td>
                                        <td>{{ $p->kegiatan->Nama_Kegiatan ?? '-' }}</td>
                                        <td style="text-align: right;">
                                            @if($status === 'Lunas')
                                                <span class="status-badge status-terdaftar">Terdaftar</span>
                                            @else
                                                <span class="status-badge status-menunggu">Menunggu pembayaran</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <!-- RINGKASAN PEMBAYARAN -->
                <div class="card">
                    <div class="card-header">
                        <h3>Ringkasan pembayaran</h3>
                    </div>

                    <div class="pembayaran-summary-grid">
                        <div>
                            <strong>Rp{{ number_format($sudahDiterima, 0, ',', '.') }}</strong>
                            <span>Sudah diterima</span>
                        </div>
                        <div style="text-align: right;">
                            <strong style="color: #695a8e;">Rp{{ number_format($menungguPembayaran, 0, ',', '.') }}</strong>
                            <span>Menunggu pembayaran</span>
                        </div>
                    </div>

                    @php
                        $totalSemua = $sudahDiterima + $menungguPembayaran;
                        $persenLunas = $totalSemua > 0 ? round(($sudahDiterima / $totalSemua) * 100) : 0;
                    @endphp
                    <div class="pembayaran-progress-bg">
                        <div class="pembayaran-progress-fill" style="width: {{ $persenLunas }}%;"></div>
                    </div>

                    <a href="{{ route('pengurus.rekap.pembayaran') }}" style="font-size: 12px; font-weight: 600; color: #5d4692; text-decoration: none;">
                        Lihat Rekap Pembayaran →
                    </a>
                </div>

            </div>

            <!-- KOLOM KANAN FIGMA -->
            <div class="right-col">

                <!-- KEGIATAN AKAN DATANG -->
                <div class="card">
                    <div class="card-header">
                        <h3>Kegiatan akan datang</h3>
                    </div>

                    @if($kegiatanAkanDatang)
                        <div class="coming-kegiatan-box">
                            <div class="coming-thumb">
                                @php
                                    $img = $kegiatanAkanDatang->Foto_Kegiatan 
                                        ? asset('storage/' . $kegiatanAkanDatang->Foto_Kegiatan)
                                        : 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=400&auto=format&fit=crop';
                                @endphp
                                <img src="{{ $img }}" alt="{{ $kegiatanAkanDatang->Nama_Kegiatan }}">
                            </div>

                            <div class="coming-info">
                                <strong>{{ $kegiatanAkanDatang->Nama_Kegiatan }}</strong>
                                <small>📅 {{ \Carbon\Carbon::parse($kegiatanAkanDatang->Tanggal_Kegiatan)->translatedFormat('d F Y') }}</small>
                                <small>📍 {{ $kegiatanAkanDatang->Lokasi ?? 'Semarang' }}</small>
                            </div>
                        </div>

                        <div class="coming-meta">
                            {{ $kegiatanAkanDatang->pendaftaran_count }} / {{ $kegiatanAkanDatang->Kuota }} pendaftar • 
                            {{ max(0, $kegiatanAkanDatang->Kuota - $kegiatanAkanDatang->pendaftaran_count) }} tempat tersisa
                        </div>

                        <a href="{{ route('pengurus.kegiatan.index') }}" style="font-size: 12px; font-weight: 600; color: #5d4692; text-decoration: none;">
                            Kelola Kegiatan →
                        </a>
                    @else
                        <div style="font-size: 12px; color: #8a7fa5;">Belum ada kegiatan terdaftar.</div>
                    @endif
                </div>

                <!-- INFORMASI PENTING -->
                <div class="info-penting-box">
                    <h4>Informasi penting</h4>
                    <p>
                        {{ $pembayaranMenungguCount }} pembayaran masih menunggu verifikasi. Pantau rekap pembayaran sebelum kegiatan dimulai.<br><br>
                        Gunakan fitur rekomendasi RAB dengan AI sebelum menyusun anggaran final kegiatan.
                    </p>
                </div>

            </div>

        </div>

    </div>
</main>

</body>
</html>
