<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulir Pendaftaran | Ranah Rengkuh</title>

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

/* GRID FORM FIGMA */
.form-layout-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.8fr) minmax(300px, 1fr);
    gap: 24px;
    align-items: start;
}

/* FORM BOX KIRI */
.form-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.05);
}

.form-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
}

.form-card-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #3b2a68;
}

.form-card-header small {
    font-size: 12px;
    color: #6c54a3;
    font-weight: 600;
}

.form-card-sub {
    font-size: 12px;
    color: #8c80a8;
    margin-bottom: 22px;
}

.form-group {
    margin-bottom: 16px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.form-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #4b3b73;
    margin-bottom: 6px;
}

.form-input, .form-textarea {
    width: 100%;
    padding: 11px 14px;
    border-radius: 9px;
    border: 1px solid #dcd3ee;
    font-size: 13px;
    color: #382c5f;
    outline: none;
    transition: border-color .2s;
    background: #ffffff;
}

.form-input:focus, .form-textarea:focus {
    border-color: #5d4692;
    box-shadow: 0 0 0 3px rgba(93, 70, 146, 0.12);
}

.checkbox-wrap {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin: 22px 0 26px;
    font-size: 12px;
    color: #57487a;
    line-height: 1.5;
}

.checkbox-wrap input {
    margin-top: 3px;
    accent-color: #5d4692;
    width: 16px;
    height: 16px;
}

.action-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
}

.btn-back-form {
    padding: 12px 26px;
    border-radius: 10px;
    border: 1px solid #d4caea;
    background: #ffffff;
    color: #55447a;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: background .2s;
}

.btn-back-form:hover {
    background: #f5f2fc;
}

.btn-submit-form {
    padding: 12px 30px;
    border-radius: 10px;
    border: none;
    background: #5d4692;
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(93, 70, 146, 0.25);
    transition: background .2s;
}

.btn-submit-form:hover {
    background: #4b367d;
}

/* RINGKASAN KEGIATAN KANAN FIGMA */
.summary-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.05);
}

.summary-card h4 {
    margin: 0 0 16px;
    font-size: 15px;
    font-weight: 700;
    color: #3b2a68;
}

.summary-thumb {
    width: 100%;
    height: 140px;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 12px;
    background: #2b2046;
}

.summary-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.summary-kategori {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    background: #eee8fc;
    color: #553e87;
    margin-bottom: 8px;
}

.summary-title {
    font-size: 16px;
    font-weight: 700;
    color: #3b2a68;
    margin-bottom: 12px;
}

.summary-meta-row {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    margin-bottom: 6px;
}

.summary-meta-row span { color: #8c80a8; }
.summary-meta-row strong { color: #3b2a68; }

.summary-price-box {
    margin-top: 18px;
    background: #f8f6fd;
    border-radius: 12px;
    padding: 14px 16px;
}

.summary-price-box small {
    display: block;
    font-size: 11px;
    color: #796c97;
    margin-bottom: 4px;
}

.summary-price-box strong {
    font-size: 22px;
    font-weight: 800;
    color: #3b2a68;
    display: block;
    margin-bottom: 4px;
}

.summary-price-box p {
    margin: 0;
    font-size: 11px;
    color: #8c80a8;
    line-height: 1.4;
}

@media(max-width: 900px) {
    .form-layout-grid { grid-template-columns: 1fr; }
    .form-row { grid-template-columns: 1fr; }
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
            <span>Kegiatan / </span> Formulir Pendaftaran
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

        <h1 class="page-title">Formulir Pendaftaran Volunteer</h1>
        <p class="page-subtitle">Lengkapi data dirimu untuk bergabung dalam kegiatan berbagi kebaikan.</p>

        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 12px 16px; border-radius: 9px; margin-bottom: 16px; font-size: 13px;">
                {{ session('error') }}
            </div>
        @endif

        <div class="form-layout-grid">

            <!-- FORMULIR KIRI FIGMA -->
            <div class="form-card">
                <form method="POST" action="{{ route('volunteer.kegiatan.daftar.submit', $kegiatan->ID_Kegiatan) }}">
                    @csrf

                    <div class="form-card-header">
                        <h3>Data diri volunteer</h3>
                        <small>Data dari profil</small>
                    </div>
                    <div class="form-card-sub">Periksa kembali informasi di bawah ini sebelum mengirim pendaftaran.</div>

                    <div class="form-group">
                        <label class="form-label">Nama lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $volunteer->Nama) }}" class="form-input" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" value="{{ $volunteer->Email }}" class="form-input" disabled style="background: #f7f5fc;">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor telepon / WhatsApp</label>
                            <input type="text" name="no_telpon" value="{{ old('no_telpon', $volunteer->No_Telpon) }}" class="form-input" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat domisili saat ini</label>
                        <input type="text" name="alamat" value="{{ old('alamat', 'Semarang, Jawa Tengah') }}" class="form-input" placeholder="Kota / Alamat lengkap" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Motivasi mengikuti kegiatan</label>
                        <textarea name="motivasi" rows="3" class="form-textarea" placeholder="Ceritakan motivasi dan apa yang ingin kamu bagikan..." required>{{ old('motivasi', 'Ingin berbagi ilmu dan mendampingi adik-adik binaan dengan penuh sukacita.') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pengalaman volunteer (opsional)</label>
                        <input type="text" name="pengalaman" value="{{ old('pengalaman', 'Belum ada pengalaman volunteer / Pernah ikut aksi lingkungan') }}" class="form-input">
                    </div>

                    <label class="checkbox-wrap">
                        <input type="checkbox" name="setuju" required checked>
                        <span>Saya telah membaca dan menyetujui ketentuan kegiatan serta bersedia mengikuti kegiatan sesuai jadwal yang ditentukan.</span>
                    </label>

                    <div class="action-buttons">
                        <a href="{{ route('volunteer.kegiatan.detail', $kegiatan->ID_Kegiatan) }}" class="btn-back-form">
                            Kembali
                        </a>
                        <button type="submit" class="btn-submit-form">
                            Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>

            <!-- RINGKASAN KEGIATAN KANAN FIGMA -->
            <div class="summary-card">
                <h4>Ringkasan kegiatan</h4>

                <div class="summary-thumb">
                    @php
                        $thumbSrc = $kegiatan->Foto_Kegiatan 
                            ? asset('storage/' . $kegiatan->Foto_Kegiatan)
                            : 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=800&auto=format&fit=crop';
                    @endphp
                    <img src="{{ $thumbSrc }}" alt="{{ $kegiatan->Nama_Kegiatan }}">
                </div>

                <span class="summary-kategori">{{ $kegiatan->Kategori ?? 'Pendidikan' }}</span>
                <div class="summary-title">{{ $kegiatan->Nama_Kegiatan }}</div>

                <div class="summary-meta-row">
                    <span>Tanggal</span>
                    <strong>{{ \Carbon\Carbon::parse($kegiatan->Tanggal_Kegiatan)->translatedFormat('d F Y') }}</strong>
                </div>

                <div class="summary-meta-row">
                    <span>Lokasi</span>
                    <strong>{{ $kegiatan->Lokasi ?? 'Semarang' }}</strong>
                </div>

                <div class="summary-price-box">
                    <small>Biaya pendaftaran</small>
                    <strong>Rp{{ number_format($kegiatan->Biaya ?? 50000, 0, ',', '.') }}</strong>
                    <p>Pembayaran dilakukan setelah pendaftaran melalui metode pembayaran yang tersedia.</p>
                </div>
            </div>

        </div>

    </div>
</main>

</body>
</html>
