<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Volunteer | Ranah Rengkuh</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #eaf4ff;
    color: #43396d;
}

/* SIDEBAR */
.sidebar {
    position: fixed;
    inset: 0 auto 0 0;
    width: 200px;
    background: #ded7f4;
    padding: 16px 12px;
    display: flex;
    flex-direction: column;
    z-index: 10;
    box-shadow: 2px 0 10px rgba(100, 80, 160, 0.08);
}

.brand {
    text-align: center;
    padding: 5px 5px 18px;
    border-bottom: 1px solid #cfc5e8;
}

.brand img {
    width: 145px;
    max-height: 65px;
    object-fit: contain;
}

.menu {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 11px 12px;
    border-radius: 9px;
    color: #5d4d87;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: all .2s;
}

.menu a:hover,
.menu a.active {
    background: #6c54a3;
    color: white;
}

.menu-icon {
    width: 20px;
    text-align: center;
    font-size: 15px;
}

.logout {
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid #cfc5e8;
}

.logout button {
    width: 100%;
    border: 0;
    background: transparent;
    color: #5d4d87;
    text-align: left;
    padding: 10px 12px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background .2s;
}

.logout button:hover {
    background: rgba(108, 84, 163, 0.15);
    color: #4b367d;
}

/* MAIN CONTENT */
.main {
    margin-left: 200px;
    min-height: 100vh;
}

.topbar {
    height: 54px;
    background: #7bbcf5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 24px;
    color: #3b2c68;
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(90, 140, 200, 0.15);
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.profile-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.45);
    padding: 5px 12px;
    border-radius: 20px;
}

.avatar {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #6c54a3;
    color: white;
    display: grid;
    place-items: center;
    font-size: 12px;
    font-weight: bold;
}

.content {
    padding: 16px 22px 30px;
}

/* ALERTS */
.alert {
    padding: 12px 16px;
    border-radius: 9px;
    font-size: 13px;
    margin-bottom: 14px;
}

.alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
.alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

/* SLIDESHOW HERO */
.slideshow-container {
    position: relative;
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 18px;
    box-shadow: 0 5px 18px rgba(95, 125, 185, 0.16);
    background: #463470;
    height: 220px;
}

.slide {
    display: none;
    position: relative;
    width: 100%;
    height: 100%;
    animation: fadeEffect 0.8s ease-in-out;
}

.slide.active {
    display: block;
}

@keyframes fadeEffect {
    from { opacity: 0.4; transform: scale(1.02); }
    to { opacity: 1; transform: scale(1); }
}

.slide-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.72);
}

.slide-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(32, 23, 62, 0.85) 0%, rgba(42, 33, 76, 0.4) 60%, transparent 100%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 24px 34px;
    color: white;
}

.slide-tag {
    display: inline-block;
    align-self: flex-start;
    padding: 4px 10px;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(6px);
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 8px;
}

.slide-title {
    font-size: 23px;
    font-weight: 800;
    margin: 0 0 6px;
    line-height: 1.3;
    text-shadow: 0 2px 8px rgba(0,0,0,0.4);
}

.slide-desc {
    font-size: 13px;
    max-width: 500px;
    margin: 0;
    color: #e5defc;
    line-height: 1.5;
}

.slide-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.3);
    color: white;
    border: none;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 16px;
    display: grid;
    place-items: center;
    transition: background .2s;
    backdrop-filter: blur(4px);
    z-index: 2;
}

.slide-nav:hover { background: rgba(255, 255, 255, 0.6); color: #3b2c68; }
.slide-prev { left: 14px; }
.slide-next { right: 14px; }

.slide-dots {
    position: absolute;
    bottom: 12px;
    left: 34px;
    display: flex;
    gap: 6px;
    z-index: 2;
}

.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    cursor: pointer;
    transition: all .2s;
}

.dot.active {
    background: #ffffff;
    width: 22px;
    border-radius: 6px;
}

/* STAT CARDS */
.stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 16px;
}

.stat {
    min-height: 85px;
    border-radius: 12px;
    padding: 15px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: 0 3px 10px rgba(80, 75, 130, 0.08);
}

.stat.purple { background: #e8dffc; }
.stat.blue { background: #d7ecff; }
.stat.yellow { background: #fff1d4; }

.stat-icon {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    border-radius: 50%;
    background: rgba(255,255,255,.75);
    font-size: 20px;
    color: #533e88;
}

.stat-label {
    font-size: 11px;
    font-weight: 700;
    color: #634f96;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.stat-value {
    font-size: 22px;
    font-weight: 800;
    color: #3b2c68;
}

.stat-note {
    font-size: 11px;
    color: #776a9c;
    margin-top: 2px;
}

/* GRID */
.dashboard-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.8fr) minmax(290px, 1.15fr);
    gap: 16px;
}

.panel {
    background: #ffffff;
    border: 1px solid #e1daf2;
    border-radius: 12px;
    padding: 18px;
    margin-bottom: 16px;
    box-shadow: 0 3px 10px rgba(90, 80, 140, 0.05);
}

.panel-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
    padding-bottom: 10px;
    border-bottom: 1px solid #f0ecf9;
}

.panel-heading h2 {
    font-size: 15px;
    font-weight: 700;
    color: #4a387e;
    margin: 0;
}

/* CARDS KEGIATAN TERSEDIA */
.available-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 14px;
}

.available-card {
    border: 1px solid #e9e3f7;
    border-radius: 10px;
    overflow: hidden;
    background: #faf9fe;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform .2s, box-shadow .2s;
}

.available-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 18px rgba(100, 80, 150, 0.12);
}

.available-thumb-box {
    width: 100%;
    height: 120px;
    background: linear-gradient(135deg, #a7cbf5, #c8b9ee);
    position: relative;
    overflow: hidden;
}

.available-thumb-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.available-thumb-placeholder {
    width: 100%;
    height: 100%;
    display: grid;
    place-items: center;
    font-size: 38px;
}

.available-card-body {
    padding: 12px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.available-badge {
    display: inline-block;
    align-self: flex-start;
    padding: 3px 8px;
    border-radius: 6px;
    background: #e5defc;
    color: #553e8a;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 6px;
}

.available-title {
    font-size: 14px;
    font-weight: 700;
    color: #3b2c68;
    margin-bottom: 6px;
    line-height: 1.35;
}

.available-desc {
    font-size: 12px;
    color: #665b8e;
    line-height: 1.45;
    margin-bottom: 10px;
}

.available-meta {
    font-size: 11px;
    color: #7a6e9f;
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-daftar {
    margin-top: 10px;
    padding: 8px 14px;
    background: #6c54a3;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
    width: 100%;
}

.btn-daftar:hover { background: #553e8a; }
.btn-disabled { background: #cfc7e6; color: #726894; cursor: not-allowed; }

/* LIST KEGIATAN SAYA */
.my-kegiatan-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 14px;
    border-radius: 9px;
    background: #fbfaff;
    border: 1px solid #ebe5f8;
    margin-bottom: 10px;
    gap: 12px;
}

.badge-status {
    padding: 4px 9px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}

.badge-lunas { background: #d4edda; color: #155724; }
.badge-menunggu { background: #fff3cd; color: #856404; }
.badge-verifikasi { background: #d1ecf1; color: #0c5460; }
.badge-ditolak { background: #f8d7da; color: #721c24; }

.pay-form {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 6px;
}

.pay-form select {
    font-size: 11px;
    padding: 4px 6px;
    border-radius: 6px;
    border: 1px solid #cbc2e6;
}

.pay-form button {
    font-size: 11px;
    padding: 4px 8px;
    background: #5c4396;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

/* INSTAGRAM FEED SECTION */
.ig-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}

.ig-profile-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.ig-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    padding: 2px;
    background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
}

.ig-avatar img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    background: white;
}

.ig-names strong {
    display: block;
    font-size: 13px;
    color: #3b2c68;
}

.ig-names span {
    font-size: 11px;
    color: #7b719c;
}

.btn-ig-follow {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 16px;
    background: linear-gradient(45deg, #f09433, #dc2743, #bc1888);
    color: white;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none;
    transition: opacity .2s;
}

.btn-ig-follow:hover { opacity: 0.9; }

.ig-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin-bottom: 12px;
}

.ig-item {
    position: relative;
    aspect-ratio: 1 / 1;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

.ig-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s;
}

.ig-item:hover img {
    transform: scale(1.08);
}

.ig-overlay {
    position: absolute;
    inset: 0;
    background: rgba(43, 31, 75, 0.65);
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity .2s;
    font-size: 11px;
    font-weight: 700;
    padding: 6px;
    text-align: center;
}

.ig-item:hover .ig-overlay {
    opacity: 1;
}

/* PROFILE FORM */
.profile-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.profile-form label { font-size: 12px; font-weight: 600; color: #553e8a; }
.profile-form input { padding: 8px 12px; border-radius: 8px; border: 1px solid #d4cbe8; font-size: 12px; }
.profile-form button { padding: 8px 12px; background: #6c54a3; color: white; border: none; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; align-self: flex-start; }

.empty-state { text-align: center; padding: 24px 10px; color: #8c82ab; font-size: 13px; }

@media(max-width: 860px) {
    .sidebar { position: relative; width: 100%; height: auto; }
    .menu { flex-direction: row; flex-wrap: wrap; }
    .main { margin-left: 0; }
    .dashboard-grid { grid-template-columns: 1fr; }
    .stats { grid-template-columns: 1fr; }
}
</style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">
        <img src="{{ asset('images/logo-ranah-rengkuh.png') }}" alt="Ranah Rengkuh">
    </div>

    <nav class="menu">
        <a href="#dashboard" class="active">
            <span class="menu-icon">⌂</span> Dashboard
        </a>
        <a href="#kegiatan-tersedia">
            <span class="menu-icon">▦</span> Kegiatan Tersedia
        </a>
        <a href="#kegiatan-saya">
            <span class="menu-icon">▣</span> Kegiatan Saya
        </a>
        <a href="#instagram-feed">
            <span class="menu-icon">📷</span> Instagram Feed
        </a>
        <a href="#profil-saya">
            <span class="menu-icon">⚙</span> Profil Saya
        </a>
    </nav>

    <div class="logout">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">↪ &nbsp; Log Out</button>
        </form>
    </div>
</aside>

<main class="main" id="dashboard">

    <header class="topbar">
        <span>Volunteer Portal · Ranah Rengkuh</span>

        <div class="topbar-right">
            <div class="profile-badge">
                <span class="avatar">{{ strtoupper(substr($nama, 0, 1)) }}</span>
                <span>{{ $nama }}</span>
            </div>
        </div>
    </header>

    <div class="content">

        @if(session('success'))
            <div class="alert alert-success">
                <span>✓ {{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <span>⚠ {{ session('error') }}</span>
            </div>
        @endif

        <!-- SLIDESHOW BANNER DOKUMENTASI KEGIATAN -->
        <section class="slideshow-container">
            <!-- Slide 1 -->
            <div class="slide active">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1200&auto=format&fit=crop" class="slide-img" alt="Dokumentasi Sosial 1">
                <div class="slide-overlay">
                    <span class="slide-tag">✨ Ranah Rengkuh Bersama Relawan</span>
                    <h1 class="slide-title">Mengukir Senyum, Menyatukan Harapan</h1>
                    <p class="slide-desc">Setiap aksi kerelawananmu membuka pintu masa depan yang lebih cerah bagi adik-adik di berbagai pelosok desa.</p>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide">
                <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1200&auto=format&fit=crop" class="slide-img" alt="Dokumentasi Sosial 2">
                <div class="slide-overlay">
                    <span class="slide-tag">🌱 Aksi Lingkungan Hijau</span>
                    <h1 class="slide-title">Langkah Nyata untuk Bumi Kita</h1>
                    <p class="slide-desc">Bergabunglah dalam gerakan penanaman pohon dan pelestarian pesisir pantai bersama ratusan pemuda lainnya.</p>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="slide">
                <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?q=80&w=1200&auto=format&fit=crop" class="slide-img" alt="Dokumentasi Sosial 3">
                <div class="slide-overlay">
                    <span class="slide-tag">🤝 Solidaritas Tanpa Batas</span>
                    <h1 class="slide-title">Berbagi Kehangatan, Merengkuh Sesama</h1>
                    <p class="slide-desc">Penyaluran bantuan nutrisi dan pemeriksaan kesehatan lansia secara langsung ke rumah-rumah warga.</p>
                </div>
            </div>

            <!-- Navigasi Slide -->
            <button class="slide-nav slide-prev" onclick="plusSlides(-1)">❮</button>
            <button class="slide-nav slide-next" onclick="plusSlides(1)">❯</button>

            <!-- Titik Indikator -->
            <div class="slide-dots">
                <span class="dot active" onclick="currentSlide(0)"></span>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
            </div>
        </section>

        <!-- STATS -->
        <section class="stats">
            <div class="stat purple">
                <div class="stat-icon">▦</div>
                <div>
                    <div class="stat-label">Kegiatan Diikuti</div>
                    <div class="stat-value">{{ $totalDiikuti }}</div>
                    <div class="stat-note">Total program terdaftar</div>
                </div>
            </div>

            <div class="stat blue">
                <div class="stat-icon">▣</div>
                <div>
                    <div class="stat-label">Selesai Berkontribusi</div>
                    <div class="stat-value">{{ $totalSelesai }}</div>
                    <div class="stat-note">Kegiatan telah selesai</div>
                </div>
            </div>

            <div class="stat yellow">
                <div class="stat-icon">⏳</div>
                <div>
                    <div class="stat-label">Menunggu Pembayaran</div>
                    <div class="stat-value">{{ $menungguPembayaran }}</div>
                    <div class="stat-note">Perlu konfirmasi / verifikasi</div>
                </div>
            </div>
        </section>

        <section class="dashboard-grid">

            <div class="left-column">

                <!-- KEGIATAN TERSEDIA -->
                <div class="panel" id="kegiatan-tersedia">
                    <div class="panel-heading">
                        <h2>🌱 Kegiatan Terbuka untuk Volunteer</h2>
                    </div>

                    @if($kegiatanTersedia->isEmpty())
                        <div class="empty-state">
                            Belum ada jadwal kegiatan terbuka saat ini. Nantikan kabar dari pengurus ya!
                        </div>
                    @else
                        <div class="available-grid">
                            @foreach($kegiatanTersedia as $k)
                                @php
                                    $isRegistered = in_array($k->ID_Kegiatan, $registeredKegiatanIds);
                                    $isFull = $k->pendaftaran_count >= $k->Kuota;
                                @endphp
                                <div class="available-card">
                                    <div class="available-thumb-box">
                                        @if($k->Foto_Kegiatan)
                                            <img src="{{ asset('storage/' . $k->Foto_Kegiatan) }}" class="available-thumb-img" alt="{{ $k->Nama_Kegiatan }}">
                                        @else
                                            <div class="available-thumb-placeholder">
                                                {{ $loop->iteration % 2 == 0 ? '🎒' : '🌱' }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="available-card-body">
                                        <div>
                                            <span class="available-badge">
                                                Kuota: {{ $k->pendaftaran_count }} / {{ $k->Kuota }}
                                            </span>
                                            <div class="available-title">{{ $k->Nama_Kegiatan }}</div>
                                            <div class="available-meta">
                                                📅 {{ \Carbon\Carbon::parse($k->Tanggal_Kegiatan)->translatedFormat('d F Y') }}
                                            </div>
                                            <div class="available-meta">
                                                👤 PJ: {{ $k->mandala->Nama ?? 'Pengurus' }}
                                            </div>
                                            <div class="available-desc">
                                                {{ Str::limit($k->Deskripsi, 90, '...') }}
                                            </div>
                                        </div>

                                        <div>
                                            @if($isRegistered)
                                                <a href="{{ route('volunteer.kegiatan.detail', $k->ID_Kegiatan) }}" class="btn-daftar btn-disabled" style="text-align: center; text-decoration: none; display: block;">✓ Sudah Terdaftar (Lihat Detail)</a>
                                            @elseif($isFull)
                                                <button class="btn-daftar btn-disabled" disabled>Kuota Penuh</button>
                                            @else
                                                <a href="{{ route('volunteer.kegiatan.detail', $k->ID_Kegiatan) }}" class="btn-daftar" style="text-align: center; text-decoration: none; display: block;">
                                                    Lihat Detail & Daftar →
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- KEGIATAN SAYA -->
                <div class="panel" id="kegiatan-saya">
                    <div class="panel-heading">
                        <h2>📋 Kegiatan yang Saya Ikuti</h2>
                    </div>

                    @if($pendaftaranList->isEmpty())
                        <div class="empty-state">
                            Kamu belum mendaftar kegiatan apa pun. Pilih salah satu kegiatan terbuka di atas ya!
                        </div>
                    @else
                        @foreach($pendaftaranList as $p)
                            @php
                                $bayar = $p->pembayaran->first();
                                $status = $bayar ? $bayar->Status : 'Belum Ada Tagihan';
                            @endphp
                            <div class="my-kegiatan-item">
                                @if($p->kegiatan->Foto_Kegiatan)
                                    <img src="{{ asset('storage/' . $p->kegiatan->Foto_Kegiatan) }}" style="width: 55px; height: 55px; border-radius: 8px; object-fit: cover;" alt="Foto Kegiatan">
                                @else
                                    <div style="width: 55px; height: 55px; border-radius: 8px; background: #e8dffc; display: grid; place-items: center; font-size: 22px;">
                                        🤝
                                    </div>
                                @endif

                                <div style="flex: 1;">
                                    <strong style="color: #412f73; font-size: 14px;">{{ $p->kegiatan->Nama_Kegiatan }}</strong>
                                    <div style="font-size: 12px; color: #6d6194; margin-top: 3px;">
                                        Pelaksanaan: <strong>{{ \Carbon\Carbon::parse($p->kegiatan->Tanggal_Kegiatan)->translatedFormat('d F Y') }}</strong> ·
                                        Daftar: {{ \Carbon\Carbon::parse($p->Tanggal_Pendaftaran)->translatedFormat('d F Y') }}
                                    </div>

                                    @if($bayar && in_array($status, ['Menunggu', 'Ditolak']))
                                        <form method="POST" action="{{ route('volunteer.pembayaran.konfirmasi', $bayar->ID_Pembayaran) }}" class="pay-form">
                                            @csrf
                                            <label style="font-size: 11px; color: #554483;">Metode Bayar:</label>
                                            <select name="metode" required>
                                                <option value="QRIS">QRIS</option>
                                                <option value="Transfer Bank BCA">Bank BCA</option>
                                                <option value="Transfer Bank Mandiri">Bank Mandiri</option>
                                                <option value="E-Wallet (Gopay/OVO)">E-Wallet</option>
                                            </select>
                                            <button type="submit">Konfirmasi Pembayaran (Rp {{ number_format($bayar->Nominal, 0, ',', '.') }})</button>
                                        </form>
                                    @endif
                                </div>

                                <div style="text-align: right;">
                                    @if($status === 'Lunas')
                                        <span class="badge-status badge-lunas">✓ Pembayaran Lunas</span>
                                    @elseif($status === 'Menunggu Verifikasi')
                                        <span class="badge-status badge-verifikasi">⏳ Verifikasi Pengurus</span>
                                    @elseif($status === 'Ditolak')
                                        <span class="badge-status badge-ditolak">✕ Ditolak</span>
                                    @else
                                        <span class="badge-status badge-menunggu">Menunggu Pembayaran</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>

            <div class="right-column">

                <!-- INSTAGRAM FEED & PROFIL KOMUNITAS SHOWCASE -->
                <div class="panel" id="instagram-feed">
                    <div class="ig-header">
                        <div class="ig-profile-info">
                            <div class="ig-avatar">
                                <img src="{{ asset('images/logo-ranah-rengkuh.png') }}" alt="Ranah Rengkuh IG">
                            </div>
                            <div class="ig-names">
                                <strong>ranahrengkuh</strong>
                                <span>Ranah Rengkuh Official</span>
                            </div>
                        </div>

                        <a href="https://instagram.com/ranahrengkuh" target="_blank" rel="noopener noreferrer" class="btn-ig-follow">
                            📸 Follow
                        </a>
                    </div>

                    <!-- Shortcut Link Resmi Komunitas -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; margin-bottom: 12px;">
                        <a href="https://ranahrengkuhh.my.canva.site/?utm_source=ig&utm_medium=social&utm_content=link_in_bio" target="_blank" rel="noopener noreferrer" style="display: flex; align-items: center; justify-content: center; gap: 5px; font-size: 11px; color: #5a428e; background: #eedeff; border: 1px solid #d9c7f6; padding: 7px 10px; border-radius: 8px; text-decoration: none; font-weight: 700; text-align: center;">
                            🌐 Website Canva
                        </a>
                        <a href="https://drive.google.com/file/d/16_KrGwKr0mpf9JGajRlDa6jLoZVFEJW_/view" target="_blank" rel="noopener noreferrer" style="display: flex; align-items: center; justify-content: center; gap: 5px; font-size: 11px; color: #3b5080; background: #dbeefd; border: 1px solid #c0e0fc; padding: 7px 10px; border-radius: 8px; text-decoration: none; font-weight: 700; text-align: center;">
                            📄 Profil Komunitas
                        </a>
                    </div>

                    <div style="font-size: 11px; color: #766996; margin-bottom: 10px;">
                        Keseruan & kabar aksi relawan terbaru di Instagram:
                    </div>

                    <div class="ig-grid">
                        @php
                            $localIgFiles = [
                                'ig-1.jpg', 'ig-2.jpg', 'ig-3.jpg',
                                'ig-4.jpg', 'ig-5.jpg', 'ig-6.jpg'
                            ];
                            $fallbackUrls = [
                                'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=400&auto=format&fit=crop',
                                'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=400&auto=format&fit=crop',
                                'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?q=80&w=400&auto=format&fit=crop',
                                'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=400&auto=format&fit=crop',
                                'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=400&auto=format&fit=crop',
                                'https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=400&auto=format&fit=crop',
                            ];
                            $captions = [
                                'Aksi Relawan',
                                'Website Canva',
                                'Company Profile',
                                'Ruang Berbagi',
                                'Kelas Edukasi',
                                'Dokumentasi'
                            ];
                            $links = [
                                'https://instagram.com/ranahrengkuh',
                                'https://ranahrengkuhh.my.canva.site/?utm_source=ig&utm_medium=social&utm_content=link_in_bio',
                                'https://drive.google.com/file/d/16_KrGwKr0mpf9JGajRlDa6jLoZVFEJW_/view',
                                'https://instagram.com/ranahrengkuh',
                                'https://instagram.com/ranahrengkuh',
                                'https://instagram.com/ranahrengkuh'
                            ];
                        @endphp

                        @for($i = 0; $i < 6; $i++)
                            @php
                                $imgSrc = file_exists(public_path('images/instagram/' . $localIgFiles[$i]))
                                    ? asset('images/instagram/' . $localIgFiles[$i])
                                    : $fallbackUrls[$i];
                            @endphp
                            <a href="{{ $links[$i] }}" target="_blank" rel="noopener noreferrer" class="ig-item" title="{{ $captions[$i] }}">
                                <img src="{{ $imgSrc }}" alt="IG Post {{ $i + 1 }}">
                                <div class="ig-overlay">
                                    <span>{{ $captions[$i] }} ↗</span>
                                </div>
                            </a>
                        @endfor
                    </div>

                    <a href="https://instagram.com/ranahrengkuh" target="_blank" rel="noopener noreferrer" style="display: block; text-align: center; font-size: 11px; color: #6a549d; text-decoration: none; font-weight: 700; padding: 7px; background: #f3effc; border-radius: 8px;">
                        Kunjungi @ranahrengkuh di Instagram ↗
                    </a>
                </div>
                        Buka Profil @ranahrengkuh di Instagram ↗
                    </a>
                </div>

                <!-- PROFIL FORM -->
                <div class="panel" id="profil-saya">
                    <div class="panel-heading">
                        <h2>⚙ Profil Volunteer</h2>
                    </div>

                    <form method="POST" action="{{ route('volunteer.profil.update') }}" class="profile-form">
                        @csrf
                        <div>
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $volunteer->Nama) }}" required style="width: 100%;">
                        </div>

                        <div>
                            <label>Email (Akun Login)</label>
                            <input type="text" value="{{ $volunteer->Email }}" disabled style="width: 100%; background: #f3f0fa;">
                        </div>

                        <div>
                            <label>Nomor WhatsApp / HP</label>
                            <input type="text" name="no_telpon" value="{{ old('no_telpon', $volunteer->No_Telpon) }}" required style="width: 100%;">
                        </div>

                        <button type="submit">Simpan Perubahan</button>
                    </form>
                </div>

            </div>

        </section>

    </div>
</main>

<script>
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
let slideInterval;

function showSlide(index) {
    if (index >= slides.length) { currentSlideIndex = 0; }
    else if (index < 0) { currentSlideIndex = slides.length - 1; }
    else { currentSlideIndex = index; }

    slides.forEach(s => s.classList.remove('active'));
    dots.forEach(d => d.classList.remove('active'));

    slides[currentSlideIndex].classList.add('active');
    dots[currentSlideIndex].classList.add('active');
}

function plusSlides(n) {
    clearInterval(slideInterval);
    showSlide(currentSlideIndex + n);
    startAutoSlide();
}

function currentSlide(n) {
    clearInterval(slideInterval);
    showSlide(n);
    startAutoSlide();
}

function startAutoSlide() {
    slideInterval = setInterval(() => {
        showSlide(currentSlideIndex + 1);
    }, 4500);
}

document.addEventListener('DOMContentLoaded', () => {
    startAutoSlide();
});
</script>

</body>
</html>
