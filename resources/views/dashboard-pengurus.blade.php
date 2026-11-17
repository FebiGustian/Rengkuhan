<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Pengurus | Ranah Rengkuh</title>

<style>
* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #eaf4ff;
    color: #514875;
}

/* SIDEBAR */
.sidebar {
    position: fixed;
    inset: 0 auto 0 0;
    width: 220px;
    background: #ded7f4;
    padding: 22px 14px;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
}

.brand {
    text-align: center;
    padding: 5px 8px 20px;
    border-bottom: 1px solid #cfc4e8;
}

.brand img {
    width: 155px;
    height: 72px;
    object-fit: contain;
}

.brand small {
    display: block;
    color: #7765a6;
    font-weight: bold;
    letter-spacing: 1.5px;
    font-size: 10px;
    margin-top: 7px;
}

.menu-label {
    font-size: 10px;
    font-weight: bold;
    color: #9689b5;
    margin: 23px 10px 10px;
    letter-spacing: 1px;
}

.menu a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    margin-bottom: 5px;
    border-radius: 9px;
    color: #655987;
    text-decoration: none;
    font-size: 12px;
    transition: .2s;
}

.menu a:hover,
.menu a.active {
    background: #69539f;
    color: white;
}

.logout {
    margin-top: auto;
    padding-top: 20px;
}

.logout button {
    width: 100%;
    padding: 12px;
    background: transparent;
    border: 0;
    color: #76638f;
    cursor: pointer;
    text-align: left;
    font-weight: bold;
}

/* MAIN */
.main {
    margin-left: 220px;
    min-height: 100vh;
}

.topbar {
    height: 65px;
    background: #79b8f3;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 28px;
    color: white;
}

.topbar strong {
    font-size: 14px;
}

.profile {
    background: rgba(255,255,255,.25);
    padding: 10px 15px;
    border-radius: 20px;
    font-size: 12px;
}

.content {
    padding: 24px 28px;
}

/* WELCOME BANNER */
.banner {
    min-height: 155px;
    padding: 27px;
    border-radius: 14px;
    background: linear-gradient(110deg, #a6c9f7, #79b5ed);
    position: relative;
    overflow: hidden;
    color: #55458a;
    margin-bottom: 20px;
}

.banner h1 {
    margin: 0 0 10px;
    font-size: 28px;
}

.banner p {
    max-width: 460px;
    line-height: 1.6;
    font-size: 12px;
}

.banner-art {
    position: absolute;
    right: 30px;
    bottom: 12px;
    font-size: 65px;
    opacity: .8;
}

/* STATISTICS */
.stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-bottom: 20px;
}

.stat {
    padding: 17px;
    border-radius: 12px;
    min-height: 105px;
    box-shadow: 0 3px 10px rgba(75,80,130,.08);
}

.stat:nth-child(1) { background: #e5dcfa; }
.stat:nth-child(2) { background: #cce6ff; }
.stat:nth-child(3) { background: #fff0c8; }
.stat:nth-child(4) { background: #d9f0e5; }

.stat .label {
    font-size: 11px;
    color: #70678d;
    display: block;
    margin-bottom: 12px;
}

.stat strong {
    font-size: 25px;
    color: #51447f;
}

/* CONTENT GRID */
.section-title {
    font-size: 15px;
    margin: 22px 0 12px;
    color: #62528e;
}

.content-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 14px;
}

.card {
    background: #fff;
    border-radius: 12px;
    padding: 17px;
    box-shadow: 0 3px 12px rgba(75,80,130,.07);
}

.card h3 {
    margin: 0 0 13px;
    font-size: 13px;
    color: #5c4b8c;
}

.empty {
    padding: 20px 5px;
    text-align: center;
    font-size: 12px;
    color: #9993ad;
    line-height: 1.7;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.quick-actions a {
    background: #f0ecfa;
    border-radius: 9px;
    padding: 13px 8px;
    text-align: center;
    color: #65558e;
    text-decoration: none;
    font-size: 11px;
}

.quick-actions a:hover {
    background: #e2d9f5;
}

@media(max-width: 950px) {
    .stats { grid-template-columns: repeat(2, 1fr); }
}

@media(max-width: 650px) {
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
    }

    .menu { display: grid; grid-template-columns: 1fr 1fr; }
    .logout { margin-top: 10px; }
    .main { margin-left: 0; }
    .topbar { padding: 0 16px; }
    .content { padding: 16px; }
    .content-grid { grid-template-columns: 1fr; }
    .banner-art { display: none; }
}
</style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">
        <img src="{{ asset('images/logo-ranah-rengkuh.png') }}" alt="Ranah Rengkuh">
        <small>PANEL PENGURUS</small>
    </div>

    <div class="menu-label">MENU UTAMA</div>

    <nav class="menu">
        <a href="{{ url('/dashboard/mandala') }}" class="active">⌂ Dashboard</a>
        <a href="#">▦ Kelola Kegiatan</a>
        <a href="#">◷ Agenda & Pengumuman</a>
        <a href="#">♙ Data Volunteer</a>
        <a href="#">▤ Data Pendaftaran</a>
        <a href="#">▣ Verifikasi Pembayaran</a>
    </nav>

    <div class="menu-label">ADMINISTRASI KEUANGAN</div>

    <nav class="menu">
        <a href="#">▤ RAB & Anggaran</a>
        <a href="#">▧ Jurnal Umum</a>
        <a href="#">▥ Laporan Keuangan</a>
    </nav>

    <div class="logout">
        <form method="POST" action="{{ url('/logout') }}">
            @csrf
            <button type="submit">↪ Logout</button>
        </form>
    </div>
</aside>

<main class="main">

    <header class="topbar">
        <strong>Dashboard</strong>
        <div class="profile">♙ {{ $nama }}</div>
    </header>

    <div class="content">

        <section class="banner">
            <h1>Halo, {{ $nama }}!</h1>
            <p>
                Selamat datang di Dashboard Pengurus Ranah Rengkuh.
                Kelola kegiatan, pantau pendaftaran, dan berikan
                pengalaman terbaik bagi Volunteer komunitas.
            </p>
            <div class="banner-art">☁️ 🕊️</div>
        </section>

        <h2 class="section-title">Ringkasan Komunitas</h2>

        <section class="stats">
            <div class="stat">
                <span class="label">Total Kegiatan</span>
                <strong>0</strong>
            </div>
            <div class="stat">
                <span class="label">Total Volunteer</span>
                <strong>0</strong>
            </div>
            <div class="stat">
                <span class="label">Total Pendaftaran</span>
                <strong>0</strong>
            </div>
            <div class="stat">
                <span class="label">Pembayaran Lunas</span>
                <strong>0</strong>
            </div>
        </section>

        <section class="content-grid">
            <div>
                <div class="card">
                    <h3>Aktivitas Terbaru</h3>
                    <div class="empty">
                        Belum ada aktivitas terbaru.
                        <br>Aktivitas komunitas akan ditampilkan di sini.
                    </div>
                </div>

                <h2 class="section-title">Menu Pengelolaan</h2>
                <div class="card">
                    <div class="quick-actions">
                        <a href="#">＋ Tambah Kegiatan</a>
                        <a href="#">▤ Data Pendaftaran</a>
                        <a href="#">♙ Data Volunteer</a>
                        <a href="#">▣ Pembayaran</a>
                    </div>
                </div>
            </div>

            <div>
                <div class="card">
                    <h3>Pengumuman</h3>
                    <div class="empty">
                        Belum ada pengumuman.
                        <br>Informasi agenda akan muncul di sini.
                    </div>
                </div>

                <h2 class="section-title">Informasi Sistem</h2>
                <div class="card">
                    <p style="font-size:12px;color:#89839f;line-height:1.7">
                        Dashboard ini digunakan untuk mengelola
                        operasional Komunitas Ranah Rengkuh.
                    </p>
                </div>
            </div>
        </section>

    </div>
</main>

</body>
</html>
