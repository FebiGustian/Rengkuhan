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
    font-family: Arial, sans-serif;
    background: #eaf4ff;
    color: #554783;
}

/* SIDEBAR */
.sidebar {
    position: fixed;
    inset: 0 auto 0 0;
    width: 170px;
    background: #ded7f4;
    padding: 15px 10px;
    display: flex;
    flex-direction: column;
    z-index: 5;
}

.brand {
    text-align: center;
    padding: 5px 5px 18px;
    border-bottom: 1px solid #cfc5e8;
}

.brand img {
    width: 135px;
    height: 70px;
    object-fit: contain;
}

.menu {
    margin-top: 16px;
}

.menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 10px;
    margin-bottom: 5px;
    border-radius: 8px;
    color: #66578e;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    transition: .2s;
}

.menu a:hover,
.menu a.active {
    background: #69539f;
    color: white;
}

.menu-icon {
    width: 18px;
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
    color: #66578e;
    text-align: left;
    padding: 12px 10px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
}

/* MAIN */
.main {
    margin-left: 170px;
    min-height: 100vh;
}

.topbar {
    height: 48px;
    background: #79b8f3;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    color: #554783;
    font-size: 11px;
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 18px;
}

.notification {
    font-size: 16px;
}

.avatar {
    width: 27px;
    height: 27px;
    border-radius: 50%;
    background: #f2eafa;
    display: grid;
    place-items: center;
    font-size: 14px;
}

.profile {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
}

.content {
    padding: 8px 12px 20px;
}

/* HERO BANNER */
.hero {
    height: 132px;
    border-radius: 9px;
    overflow: hidden;
    position: relative;
    padding: 20px;
    background:
        radial-gradient(ellipse at 10% 110%, #fff4db 0 13%, transparent 14%),
        radial-gradient(ellipse at 35% 120%, #fff 0 17%, transparent 18%),
        radial-gradient(ellipse at 75% 115%, #fff2d9 0 15%, transparent 16%),
        linear-gradient(180deg, #d8edff 0%, #a8d5fb 65%, #f4f4ff 100%);
    margin-bottom: 9px;
}

.hero h1 {
    font-size: 23px;
    margin: 0 0 7px;
    color: #66539b;
}

.hero p {
    font-size: 9px;
    line-height: 1.6;
    max-width: 330px;
    margin: 0;
    color: #655b91;
}

.hero-decoration {
    position: absolute;
    right: 28px;
    bottom: 5px;
    font-size: 48px;
    letter-spacing: 5px;
}

.bird {
    position: absolute;
    color: #f6a36d;
    font-size: 20px;
}

.bird.one { right: 38%; top: 18px; }
.bird.two { right: 28%; top: 32px; }
.bird.three { right: 18%; top: 13px; }

/* STAT CARDS */
.stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 8px;
    margin-bottom: 9px;
}

.stat {
    min-height: 90px;
    border-radius: 9px;
    padding: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 2px 5px rgba(75, 70, 120, .10);
}

.stat.purple { background: #e7ddfa; }
.stat.blue { background: #d2eaff; }
.stat.yellow { background: #fff0cf; }

.stat-icon {
    width: 37px;
    height: 37px;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    border-radius: 50%;
    background: rgba(255,255,255,.65);
    font-size: 19px;
}

.stat-label {
    font-size: 9px;
    font-weight: bold;
    color: #66559a;
    margin-bottom: 5px;
}

.stat-value {
    font-size: 21px;
    font-weight: bold;
    color: #4f4385;
}

.stat-note {
    font-size: 8px;
    color: #8279a1;
    margin-top: 4px;
}

/* DASHBOARD COLUMNS */
.dashboard-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.55fr) minmax(210px, .9fr);
    gap: 9px;
}

.panel {
    background: #f8f6ff;
    border: 1px solid #e3dcf2;
    border-radius: 9px;
    padding: 10px;
    box-shadow: 0 2px 5px rgba(75,70,120,.08);
    margin-bottom: 9px;
}

.panel-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 9px;
}

.panel-heading h2 {
    margin: 0;
    font-size: 12px;
    color: #59488d;
}

.panel-heading a {
    color: #8272b0;
    font-size: 8px;
    text-decoration: none;
}

.activity {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f6f3fc;
    border: 1px solid #d9d1e8;
    border-radius: 7px;
    padding: 6px;
    margin-bottom: 6px;
}

.activity-image {
    width: 52px;
    height: 48px;
    flex-shrink: 0;
    border-radius: 5px;
    background: linear-gradient(140deg, #a8d6ad, #e7d8a8);
    display: grid;
    place-items: center;
    font-size: 24px;
}

.activity-info {
    flex: 1;
    min-width: 0;
}

.activity-info strong {
    display: block;
    font-size: 9px;
    color: #554783;
    margin-bottom: 5px;
}

.activity-info small {
    display: block;
    font-size: 8px;
    color: #827a9b;
    margin-bottom: 4px;
}

.tag {
    display: inline-block;
    padding: 3px 6px;
    border-radius: 10px;
    font-size: 7px;
    background: #d9f2d9;
    color: #43844d;
    margin-right: 3px;
}

.tag.pending {
    background: #fff0c9;
    color: #9b7930;
}

.tag.done {
    background: #e7ddfa;
    color: #69539f;
}

.detail-link {
    font-size: 8px;
    color: #7563a4;
    text-decoration: none;
    white-space: nowrap;
}

/* ANNOUNCEMENT */
.announcement {
    background: white;
    padding: 12px;
    border-radius: 7px;
    box-shadow: 0 2px 5px rgba(75,70,120,.12);
}

.announcement h3 {
    font-size: 13px;
    margin: 0 0 9px;
    color: #5b4a91;
}

.announcement p {
    font-size: 9px;
    line-height: 1.6;
    color: #827a9b;
    margin: 0;
}

.announcement small {
    display: block;
    font-size: 8px;
    color: #a29ab7;
    margin-top: 8px;
}

/* AVAILABLE ACTIVITIES */
.available-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 7px;
}

.available-card {
    border: 1px solid #d9d1e8;
    border-radius: 7px;
    padding: 6px;
    background: #f8f6ff;
}

.available-image {
    height: 75px;
    border-radius: 5px;
    background: linear-gradient(135deg, #a4d5a9, #e8dfb4);
    display: grid;
    place-items: center;
    font-size: 32px;
    margin-bottom: 6px;
}

.available-card strong {
    display: block;
    font-size: 9px;
    margin-bottom: 5px;
}

.available-card small {
    display: block;
    font-size: 8px;
    color: #827a9b;
    margin-bottom: 4px;
}

.available-card a {
    display: inline-block;
    text-decoration: none;
    color: #fff;
    background: #8a78c0;
    border-radius: 10px;
    font-size: 8px;
    padding: 4px 8px;
    margin-top: 4px;
}

/* MOTIVATION */
.motivation {
    min-height: 125px;
    border-radius: 8px;
    padding: 20px 12px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    background:
        radial-gradient(ellipse at 10% 110%, #fff 0 17%, transparent 18%),
        radial-gradient(ellipse at 90% 110%, #fff1d9 0 20%, transparent 21%),
        linear-gradient(140deg, #d9edff, #b7d8f7);
}

.motivation p {
    max-width: 180px;
    font-size: 13px;
    line-height: 1.6;
    font-style: italic;
    color: #7766a5;
    font-weight: bold;
}

.empty {
    text-align: center;
    padding: 15px 5px;
    font-size: 9px;
    color: #9991ae;
    line-height: 1.6;
}

@media(max-width: 760px) {
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
    }

    .brand img { height: 55px; }
    .menu { display: grid; grid-template-columns: repeat(2, 1fr); }
    .logout { margin-top: 5px; }
    .main { margin-left: 0; }
    .dashboard-grid { grid-template-columns: 1fr; }
}

@media(max-width: 480px) {
    .stats { grid-template-columns: 1fr; }
    .hero-decoration { display: none; }
    .available-grid { grid-template-columns: 1fr 1fr; }
}
</style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">
        <img src="{{ asset('images/logo-ranah-rengkuh.png') }}" alt="Ranah Rengkuh">
    </div>

    <nav class="menu">
        <a href="{{ url('/dashboard/volunteer') }}" class="active">
            <span class="menu-icon">⌂</span> Dashboard
        </a>
        <a href="#">
            <span class="menu-icon">▦</span> Kegiatan
        </a>
        <a href="#">
            <span class="menu-icon">▣</span> Pembayaran
        </a>
        <a href="#">
            <span class="menu-icon">◷</span> Riwayat
        </a>
    </nav>

    <div class="logout">
        <form method="POST" action="{{ url('/logout') }}">
            @csrf
            <button type="submit">↪ &nbsp; Log Out</button>
        </form>
    </div>
</aside>

<main class="main">

    <header class="topbar">
        <span>Dashboard</span>

        <div class="topbar-right">
            <span class="notification">♧</span>
            <div class="profile">
                <span class="avatar">♙</span>
                {{ $nama }}
            </div>
        </div>
    </header>

    <div class="content">

        <section class="hero">
            <h1>Halo, {{ $nama }}!</h1>
            <p>
                Senang sekali kamu sudah bergabung sebagai Volunteer
                Ranah Rengkuh. Yuk, lanjutkan kontribusimu dan sebarkan
                kebaikan!
            </p>

            <span class="bird one">⌁</span>
            <span class="bird two">⌁</span>
            <span class="bird three">⌁</span>
            <div class="hero-decoration">🎒 🧑🏻‍🤝‍🧑🏼</div>
        </section>

        <section class="stats">
            <div class="stat purple">
                <div class="stat-icon">▦</div>
                <div>
                    <div class="stat-label">Kegiatan Diikuti</div>
                    <div class="stat-value">0</div>
                    <div class="stat-note">Kegiatan terdaftar</div>
                </div>
            </div>

            <div class="stat blue">
                <div class="stat-icon">▣</div>
                <div>
                    <div class="stat-label">Status Pembayaran</div>
                    <div class="stat-value">0 / 0</div>
                    <div class="stat-note">Lunas · Belum bayar</div>
                </div>
            </div>

            <div class="stat yellow">
                <div class="stat-icon">♟</div>
                <div>
                    <div class="stat-label">Status Pendaftaran</div>
                    <div class="stat-value">Terdaftar</div>
                    <div class="stat-note">Jumlah kegiatan terdaftar: 0</div>
                </div>
            </div>
        </section>

        <section class="dashboard-grid">

            <div class="left-column">

                <div class="panel">
                    <div class="panel-heading">
                        <h2>Kegiatan Saya</h2>
                        <a href="#">Lihat Semua →</a>
                    </div>

                    <div class="empty">
                        Kamu belum mengikuti kegiatan apa pun.
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <h2>Kegiatan Tersedia</h2>
                        <a href="#">Lihat Semua →</a>
                    </div>

                    <div class="available-grid">
                        <div class="available-card">
                            <div class="available-image">🌱</div>
                            <strong>Berbagi Kebaikan</strong>
                            <small>▦ Jadwal kegiatan</small>
                            <small>⌖ Lokasi kegiatan</small>
                            <a href="#">Lihat Detail</a>
                        </div>

                        <div class="available-card">
                            <div class="available-image">🤝</div>
                            <strong>Kelas Berbagi</strong>
                            <small>▦ Jadwal kegiatan</small>
                            <small>⌖ Lokasi kegiatan</small>
                            <a href="#">Lihat Detail</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="right-column">

                <div class="panel">
                    <div class="panel-heading">
                        <h2>◀ Pengumuman</h2>
                    </div>

                    <div class="announcement">
                        <h3>Jangan lupa!</h3>
                        <p>
                            Pantau terus informasi kegiatan dan
                            pengumuman terbaru dari Komunitas
                            Ranah Rengkuh.
                        </p>
                        <small>Informasi dari pengurus</small>
                    </div>
                </div>

                <div class="motivation">
                    <p>
                        Langkah kecil kamu,
                        berarti besar untuk mereka ♡
                    </p>
                </div>

            </div>

        </section>
    </div>
</main>

</body>
</html>
