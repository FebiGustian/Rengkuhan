<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Kegiatan | Ranah Rengkuh</title>

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

/* FORM CARD FIGMA */
.form-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 28px 32px;
    max-width: 900px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.04);
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    margin-bottom: 18px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 16px;
}

.form-group label {
    font-size: 12px;
    font-weight: 700;
    color: #4b3977;
}

.form-input, .form-select, .form-textarea {
    width: 100%;
    padding: 11px 14px;
    border-radius: 9px;
    border: 1px solid #dcd3ee;
    font-size: 13px;
    color: #3b2a68;
    background: #ffffff;
    outline: none;
    transition: border-color .2s;
}

.form-input:focus, .form-select:focus, .form-textarea:focus {
    border-color: #5d4692;
    box-shadow: 0 0 0 3px rgba(93, 70, 146, 0.12);
}

.form-actions {
    display: flex;
    gap: 14px;
    margin-top: 24px;
}

.btn-batal {
    padding: 12px 24px;
    border: 1px solid #d6cbe9;
    background: #ffffff;
    color: #55447a;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
}

.btn-simpan {
    padding: 12px 28px;
    border: none;
    background: #5d4692;
    color: #ffffff;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(93, 70, 146, 0.2);
}

@media(max-width: 900px) {
    .form-grid { grid-template-columns: 1fr; }
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
        <a href="{{ route('pengurus.kegiatan.index') }}" class="active">
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
            <span>Manajemen / Kelola Kegiatan / </span> Tambah Kegiatan
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

        <h1 class="page-title">Tambah Kegiatan Baru</h1>
        <p class="page-subtitle">Lengkapi formulir untuk mempublikasikan program kerelawanan baru.</p>

        <div class="form-card">
            <form method="POST" action="{{ route('pengurus.kegiatan.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" class="form-input" placeholder="Contoh: Mengajar Anak Binaan" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Lingkungan">Lingkungan</option>
                            <option value="Sosial">Sosial</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal_kegiatan" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label>Waktu Kegiatan</label>
                        <input type="text" name="waktu" class="form-input" placeholder="09.00 - 12.00 WIB" value="09.00 - 12.00 WIB">
                    </div>

                    <div class="form-group">
                        <label>Lokasi Kegiatan</label>
                        <input type="text" name="lokasi" class="form-input" placeholder="Kota / Alamat lokasi" value="Semarang" required>
                    </div>

                    <div class="form-group">
                        <label>Penyelenggara</label>
                        <input type="text" name="penyelenggara" class="form-input" placeholder="Ranah Rengkuh" value="Ranah Rengkuh">
                    </div>

                    <div class="form-group">
                        <label>Kuota Relawan</label>
                        <input type="number" name="kuota" class="form-input" min="1" max="1000" placeholder="20" required>
                    </div>

                    <div class="form-group">
                        <label>Biaya Pendaftaran / Komitmen (Rp)</label>
                        <input type="number" name="biaya" class="form-input" min="0" placeholder="50000" value="50000" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Foto Poster / Dokumentasi Kegiatan</label>
                    <input type="file" name="foto_kegiatan" class="form-input" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Deskripsi Kegiatan</label>
                    <textarea name="deskripsi" rows="3" class="form-textarea" placeholder="Jelaskan gambaran umum kegiatan..."></textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Tujuan Kegiatan</label>
                        <textarea name="tujuan" rows="2" class="form-textarea" placeholder="Tujuan yang ingin dicapai..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Aktivitas Volunteer</label>
                        <textarea name="aktivitas" rows="2" class="form-textarea" placeholder="Hal apa saja yang dilakukan volunteer..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Persyaratan Volunteer</label>
                        <textarea name="persyaratan" rows="2" class="form-textarea" placeholder="Syarat usia, komitmen, dll..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Perlengkapan yang Dibawa</label>
                        <textarea name="perlengkapan" rows="2" class="form-textarea" placeholder="Alat tulis, botol minum, pakaian..."></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('pengurus.kegiatan.index') }}" class="btn-batal">Batal</a>
                    <button type="submit" class="btn-simpan">Publikasikan Kegiatan</button>
                </div>
            </form>
        </div>

    </div>
</main>

</body>
</html>
