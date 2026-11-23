<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $kegiatan->Nama_Kegiatan }} | Ranah Rengkuh</title>

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

.brand {
    padding: 0 8px 24px;
}

.brand img {
    width: 140px;
    max-height: 60px;
    object-fit: contain;
}

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

.menu a svg {
    width: 19px;
    height: 19px;
    fill: currentColor;
}

.sidebar-cloud {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    pointer-events: none;
    opacity: 0.9;
}

.logout-box {
    margin-top: auto;
    padding-top: 20px;
    position: relative;
    z-index: 2;
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

.logout-box button:hover {
    background: rgba(93, 70, 146, 0.12);
}

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

.breadcrumb {
    color: #2b1d56;
}

.breadcrumb span {
    opacity: 0.7;
}

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

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #4b3977;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 18px;
    transition: opacity .2s;
}

.btn-back:hover { opacity: 0.8; }

/* DETAIL GRID FIGMA */
.detail-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.8fr) minmax(320px, 1.15fr);
    gap: 24px;
    align-items: start;
}

/* BANNER GAMBAR */
.banner-image-box {
    position: relative;
    border-radius: 18px;
    overflow: hidden;
    height: 330px;
    box-shadow: 0 4px 16px rgba(60, 45, 110, 0.08);
    background: #2b2046;
}

.banner-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.badge-kategori {
    position: absolute;
    top: 18px;
    left: 20px;
    background: rgba(255, 255, 255, 0.88);
    color: #553e87;
    backdrop-filter: blur(8px);
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}

.detail-title {
    font-size: 26px;
    font-weight: 800;
    color: #3b2a68;
    margin: 22px 0 10px;
}

.detail-desc {
    font-size: 14px;
    line-height: 1.6;
    color: #5a4b80;
    margin-bottom: 22px;
}

/* META 4 KOTAK / INFO BAR */
.meta-info-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 18px 24px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    border: 1px solid #ebe4f7;
    margin-bottom: 22px;
    box-shadow: 0 2px 10px rgba(60, 45, 110, 0.04);
}

.meta-item small {
    display: block;
    font-size: 11px;
    color: #8b80a6;
    margin-bottom: 4px;
}

.meta-item strong {
    font-size: 13px;
    color: #3f2f6a;
}

/* 4 KOTAK PENJELASAN (TUJUAN, AKTIVITAS, PERSYARATAN, PERLENGKAPAN) */
.section-boxes-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.info-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 14px;
    padding: 18px 20px;
    box-shadow: 0 2px 10px rgba(60, 45, 110, 0.04);
}

.info-card h4 {
    margin: 0 0 8px;
    font-size: 14px;
    font-weight: 700;
    color: #433171;
}

.info-card p {
    margin: 0;
    font-size: 13px;
    line-height: 1.55;
    color: #635489;
}

/* SIDEBAR KANAN: CARD PENDAFTARAN FIGMA */
.register-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.06);
    margin-bottom: 18px;
}

.register-card h3 {
    margin: 0 0 10px;
    font-size: 17px;
    font-weight: 700;
    color: #3b2a68;
}

.badge-tersedia {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    background: #e2f7ec;
    color: #17834a;
    margin-bottom: 14px;
}

.badge-penuh {
    background: #fde8e8;
    color: #c81e1e;
}

.sisa-kuota-number {
    font-size: 28px;
    font-weight: 800;
    color: #3b2a68;
    margin-bottom: 2px;
}

.sisa-kuota-sub {
    font-size: 12px;
    color: #8375a0;
    margin-bottom: 14px;
}

.progress-header {
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    color: #55447a;
    font-weight: 600;
    margin-bottom: 6px;
}

.progress-bar-bg {
    width: 100%;
    height: 8px;
    background: #ebe5f7;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 6px;
}

.progress-bar-fill {
    height: 100%;
    background: #5d4692;
    border-radius: 10px;
}

.progress-total {
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    color: #8c80a8;
    margin-bottom: 20px;
}

/* BIAYA PENDAFTARAN BOX */
.price-box {
    background: #f8f6fd;
    border-radius: 12px;
    padding: 16px 18px;
    margin-bottom: 20px;
}

.price-box small {
    display: block;
    font-size: 11px;
    color: #796c97;
    margin-bottom: 4px;
}

.price-box strong {
    font-size: 26px;
    font-weight: 800;
    color: #3b2a68;
    display: block;
    margin-bottom: 6px;
}

.price-box p {
    margin: 0;
    font-size: 11px;
    color: #8679a2;
    line-height: 1.45;
}

.btn-daftar-figma {
    width: 100%;
    padding: 14px 20px;
    background: #5d4692;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    display: block;
    box-shadow: 0 4px 12px rgba(93, 70, 146, 0.25);
    transition: background .2s, transform .2s;
}

.btn-daftar-figma:hover {
    background: #4e387f;
    transform: translateY(-2px);
}

.btn-disabled-figma {
    background: #cfc7e5;
    cursor: not-allowed;
    box-shadow: none;
}

.footnote {
    font-size: 11px;
    color: #8f84aa;
    text-align: center;
    margin-top: 10px;
}

/* SEBELUM MENDAFTAR CARD */
.note-card {
    background: #f1edfb;
    border-radius: 14px;
    padding: 18px 20px;
    border: 1px solid #e2daf3;
}

.note-card h5 {
    margin: 0 0 6px;
    font-size: 13px;
    font-weight: 700;
    color: #55447a;
}

.note-card p {
    margin: 0;
    font-size: 12px;
    line-height: 1.5;
    color: #6e5f8e;
}

@media(max-width: 900px) {
    .detail-grid { grid-template-columns: 1fr; }
    .sidebar { position: relative; width: 100%; }
    .main { margin-left: 0; }
    .section-boxes-grid { grid-template-columns: 1fr; }
    .meta-info-card { grid-template-columns: 1fr 1fr; }
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
        <a href="{{ route('volunteer.kegiatan') }}" class="active">
            <span>📅</span> Kegiatan
        </a>
        <a href="{{ route('volunteer.pembayaran') }}">
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
            <span>Kegiatan / </span> Detail kegiatan
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

        <a href="{{ route('volunteer.dashboard') }}" class="btn-back">
            ← Kembali ke Kegiatan
        </a>

        @php
            $isRegistered = in_array($kegiatan->ID_Kegiatan, $registeredKegiatanIds ?? []);
            $pendaftarCount = $kegiatan->pendaftaran_count ?? $kegiatan->pendaftaran->count();
            $sisaKuota = max(0, $kegiatan->Kuota - $pendaftarCount);
            $persenTerisi = $kegiatan->Kuota > 0 ? min(100, round(($pendaftarCount / $kegiatan->Kuota) * 100)) : 0;
            $isFull = $sisaKuota <= 0;

            // Foto Fallback
            $imgSrc = $kegiatan->Foto_Kegiatan 
                ? asset('storage/' . $kegiatan->Foto_Kegiatan)
                : 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1200&auto=format&fit=crop';
        @endphp

        <div class="detail-grid">

            <!-- KOLOM KIRI (FOTO, DESKRIPSI, 4 BOXES) -->
            <div class="left-col">

                <div class="banner-image-box">
                    <img src="{{ $imgSrc }}" alt="{{ $kegiatan->Nama_Kegiatan }}" class="banner-image">
                    <span class="badge-kategori">{{ $kegiatan->Kategori ?? 'Pendidikan' }}</span>
                </div>

                <h1 class="detail-title">{{ $kegiatan->Nama_Kegiatan }}</h1>
                <p class="detail-desc">
                    {{ $kegiatan->Deskripsi ?? 'Bersama-sama memberikan pendampingan belajar untuk adik-adik binaan. Kegiatan ini bertujuan untuk meningkatkan semangat belajar dan menumbuhkan rasa percaya diri anak-anak. Mari berbagi ilmu melalui belajar dan bermain bersama.' }}
                </p>

                <!-- META 4 ITEM -->
                <div class="meta-info-card">
                    <div class="meta-item">
                        <small>Tanggal</small>
                        <strong>{{ \Carbon\Carbon::parse($kegiatan->Tanggal_Kegiatan)->translatedFormat('d F Y') }}</strong>
                    </div>
                    <div class="meta-item">
                        <small>Waktu</small>
                        <strong>{{ $kegiatan->Waktu ?? '09.00–12.00 WIB' }}</strong>
                    </div>
                    <div class="meta-item">
                        <small>Lokasi</small>
                        <strong>{{ $kegiatan->Lokasi ?? 'Semarang' }}</strong>
                    </div>
                    <div class="meta-item">
                        <small>Penyelenggara</small>
                        <strong>{{ $kegiatan->Penyelenggara ?? 'Ranah Rengkuh' }}</strong>
                    </div>
                </div>

                <!-- 4 KOTAK INFORMASI FIGMA -->
                <div class="section-boxes-grid">
                    <div class="info-card">
                        <h4>Tujuan Kegiatan</h4>
                        <p>{{ $kegiatan->Tujuan ?? 'Meningkatkan semangat belajar, kemampuan dasar, dan rasa percaya diri adik-adik binaan di wilayah pengabdian.' }}</p>
                    </div>

                    <div class="info-card">
                        <h4>Aktivitas Volunteer</h4>
                        <p>{{ $kegiatan->Aktivitas ?? 'Mendampingi baca-tulis dan berhitung, bermain edukatif, games seru, serta sesi cerita bersama.' }}</p>
                    </div>

                    <div class="info-card">
                        <h4>Persyaratan Volunteer</h4>
                        <p>{{ $kegiatan->Persyaratan ?? 'Usia minimal 18 tahun, sabar, komunikatif, dan berkomitmen mengikuti kegiatan hingga selesai.' }}</p>
                    </div>

                    <div class="info-card">
                        <h4>Perlengkapan yang Dibawa</h4>
                        <p>{{ $kegiatan->Perlengkapan ?? 'Alat tulis, buku bacaan anak, botol minum pribadi, serta pakaian rapi dan nyaman.' }}</p>
                    </div>
                </div>

            </div>

            <!-- KOLOM KANAN (CARD PENDAFTARAN) -->
            <div class="right-col">

                <div class="register-card">
                    <h3>Pendaftaran Volunteer</h3>

                    @if($isFull)
                        <span class="badge-tersedia badge-penuh">Kuota Penuh</span>
                    @else
                        <span class="badge-tersedia">Masih tersedia</span>
                    @endif

                    <div class="sisa-kuota-number">{{ $sisaKuota }} volunteer</div>
                    <div class="sisa-kuota-sub">Sisa kuota untuk kegiatan ini</div>

                    <div class="progress-header">
                        <span>{{ $pendaftarCount }} volunteer terdaftar</span>
                        <span>{{ $persenTerisi }}%</span>
                    </div>

                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: {{ $persenTerisi }}%;"></div>
                    </div>

                    <div class="progress-total">
                        <span>Total kuota</span>
                        <span>{{ $kegiatan->Kuota }} volunteer</span>
                    </div>

                    <div class="price-box">
                        <small>Biaya pendaftaran / komitmen</small>
                        <strong>Rp{{ number_format($kegiatan->Biaya ?? 50000, 0, ',', '.') }}</strong>
                        <p>Pembayaran dilakukan setelah pendaftaran melalui metode pembayaran yang tersedia.</p>
                    </div>

                    @if($isRegistered)
                        <button class="btn-daftar-figma btn-disabled-figma" disabled>✓ Sudah Terdaftar</button>
                    @elseif($isFull)
                        <button class="btn-daftar-figma btn-disabled-figma" disabled>Kuota Penuh</button>
                    @else
                        <a href="{{ route('volunteer.kegiatan.daftar.form', $kegiatan->ID_Kegiatan) }}" class="btn-daftar-figma">
                            Daftar Sekarang
                        </a>
                    @endif

                    <div class="footnote">
                        Pilih Daftar Sekarang untuk mengisi formulir pendaftaran kegiatan.
                    </div>
                </div>

                <div class="note-card">
                    <h5>Sebelum mendaftar</h5>
                    <p>Pastikan kamu dapat hadir sesuai jadwal dan telah membaca persyaratan serta perlengkapan kegiatan.</p>
                </div>

            </div>

        </div>

    </div>
</main>

</body>
</html>
