<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Administrator | Ranah Rengkuh</title>

<style>
* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #eaf4ff;
    color: #40346b;
}

/* SIDEBAR */
.sidebar {
    position: fixed;
    inset: 0 auto 0 0;
    width: 220px;
    background: #ded7f4;
    padding: 20px 14px;
    display: flex;
    flex-direction: column;
    z-index: 10;
    box-shadow: 2px 0 10px rgba(90, 70, 150, 0.08);
}

.brand {
    text-align: center;
    padding: 5px 8px 18px;
    border-bottom: 1px solid #cfc4e8;
}

.brand img {
    width: 150px;
    max-height: 65px;
    object-fit: contain;
}

.brand small {
    display: block;
    color: #6a5697;
    font-weight: 700;
    letter-spacing: 1.5px;
    font-size: 11px;
    margin-top: 6px;
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
    gap: 12px;
    padding: 11px 14px;
    border-radius: 9px;
    color: #584a7e;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: all .2s;
}

.menu a:hover,
.menu a.active {
    background: #69539f;
    color: white;
}

.logout {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid #cfc4e8;
}

.logout button {
    width: 100%;
    padding: 10px 12px;
    background: transparent;
    border: 0;
    color: #6a5789;
    cursor: pointer;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 8px;
    border-radius: 8px;
}

.logout button:hover {
    background: rgba(105, 83, 159, 0.15);
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
    padding: 0 28px;
    color: #2b1f52;
    box-shadow: 0 2px 8px rgba(80, 130, 200, 0.15);
}

.profile-tag {
    background: rgba(255,255,255,.45);
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.content {
    padding: 20px 28px 40px;
}

/* ALERTS */
.alert {
    padding: 12px 16px;
    border-radius: 9px;
    font-size: 13px;
    margin-bottom: 16px;
}

.alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
.alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

/* BANNER */
.banner {
    min-height: 130px;
    padding: 22px 28px;
    border-radius: 12px;
    background: linear-gradient(110deg, #ffd3b6, #ffaaa5);
    position: relative;
    overflow: hidden;
    color: #522d2d;
    margin-bottom: 18px;
    box-shadow: 0 4px 15px rgba(200, 120, 100, 0.12);
}

.banner h1 {
    margin: 0 0 6px;
    font-size: 24px;
}

.banner p {
    max-width: 520px;
    line-height: 1.5;
    font-size: 13px;
    margin: 0;
}

.banner-art {
    position: absolute;
    right: 28px;
    bottom: 10px;
    font-size: 55px;
    opacity: .85;
}

/* STATS */
.stats {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 12px;
    margin-bottom: 22px;
}

.stat {
    padding: 15px;
    border-radius: 12px;
    min-height: 90px;
    box-shadow: 0 3px 10px rgba(75,80,130,.06);
    background: #fff;
}

.stat:nth-child(1) { background: #e8deff; }
.stat:nth-child(2) { background: #d5ecff; }
.stat:nth-child(3) { background: #fff1d2; }
.stat:nth-child(4) { background: #daf3e7; }
.stat:nth-child(5) { background: #ffdada; }

.stat .label {
    font-size: 10px;
    font-weight: 700;
    color: #655887;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: block;
    margin-bottom: 6px;
}

.stat strong {
    font-size: 20px;
    color: #3b2c68;
}

/* CARDS & TABLES */
.card {
    background: #fff;
    border: 1px solid #e1daf2;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 3px 12px rgba(75,80,130,.05);
}

.card h3 {
    margin: 0 0 16px;
    font-size: 15px;
    font-weight: 700;
    color: #49377b;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-responsive {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
}

th {
    background: #f7f5fd;
    color: #554580;
    text-align: left;
    padding: 10px 12px;
    border-bottom: 2px solid #e8e2f6;
    font-weight: 700;
}

td {
    padding: 11px 12px;
    border-bottom: 1px solid #f0ecf8;
    color: #4a3e70;
    vertical-align: middle;
}

tr:hover td {
    background: #faf8fe;
}

/* BADGES */
.badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
}

.badge-success { background: #d4edda; color: #155724; }
.badge-warning { background: #fff3cd; color: #856404; }
.badge-info { background: #d1ecf1; color: #0c5460; }
.badge-danger { background: #f8d7da; color: #721c24; }

/* FORMS */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 12px;
    margin-bottom: 12px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.form-group label {
    font-size: 11px;
    font-weight: 700;
    color: #594883;
}

.form-control {
    padding: 8px 10px;
    border-radius: 8px;
    border: 1px solid #d4cde5;
    font-size: 12px;
}

.btn-primary {
    background: #69539f;
    color: white;
    border: 0;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
}

.btn-primary:hover { background: #554185; }

.btn-sm {
    padding: 4px 8px;
    font-size: 11px;
    border-radius: 6px;
    border: 0;
    cursor: pointer;
    font-weight: 600;
}

.btn-danger-sm { background: #f8d7da; color: #721c24; }

@media(max-width: 950px) {
    .stats { grid-template-columns: repeat(2, 1fr); }
    .sidebar { position: relative; width: 100%; height: auto; }
    .menu { flex-direction: row; flex-wrap: wrap; }
    .main { margin-left: 0; }
}
</style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">
        <img src="{{ asset('images/logo-ranah-rengkuh.png') }}" alt="Ranah Rengkuh">
        <small>PORTAL ADMINISTRATOR</small>
    </div>

    <nav class="menu">
        <a href="#overview" class="active">
            <span>⌂</span> Dashboard
        </a>
        <a href="#kelola-pengurus">
            <span>👥</span> Manajemen Mandala
        </a>
        <a href="#kelola-volunteer">
            <span>🤝</span> Data Volunteer
        </a>
        <a href="#keuangan-coa">
            <span>📊</span> COA & Kas Masuk
        </a>
    </nav>

    <div class="logout">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">↪ &nbsp; Log Out</button>
        </form>
    </div>
</aside>

<main class="main">

    <header class="topbar">
        <strong>Administrator System · Ranah Rengkuh</strong>
        <div class="profile-tag">
            🛡 {{ $nama }} (Super Admin)
        </div>
    </header>

    <div class="content" id="overview">

        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                ⚠ {{ session('error') }}
            </div>
        @endif

        <div class="banner">
            <h1>Selamat Datang, Admin Utama! 🚀</h1>
            <p>
                Pusat kendali operasional Ranah Rengkuh. Kelola hak akses pengurus (Mandala), pantau database relawan, serta monitoring aliran dana kegiatan sosial.
            </p>
            <div class="banner-art">🛡 📊</div>
        </div>

        <section class="stats">
            <div class="stat">
                <span class="label">Total Pengurus</span>
                <strong>{{ $totalMandala }}</strong>
            </div>
            <div class="stat">
                <span class="label">Total Volunteer</span>
                <strong>{{ $totalVolunteer }}</strong>
            </div>
            <div class="stat">
                <span class="label">Total Kegiatan</span>
                <strong>{{ $totalKegiatan }}</strong>
            </div>
            <div class="stat">
                <span class="label">Total Partisipasi</span>
                <strong>{{ $totalPendaftaran }}</strong>
            </div>
            <div class="stat">
                <span class="label">Total Kas Masuk</span>
                <strong>Rp {{ number_format($totalKas, 0, ',', '.') }}</strong>
            </div>
        </section>

        <!-- MANAJEMEN PENGURUS (MANDALA) -->
        <div class="card" id="kelola-pengurus">
            <h3>
                <span>👥 Manajemen Akun Pengurus & Administrator</span>
            </h3>

            <!-- Form Tambah Pengurus -->
            <form method="POST" action="{{ route('admin.mandala.store') }}" style="background: #faf8fe; padding: 14px; border-radius: 8px; margin-bottom: 16px; border: 1px solid #eae2f8;">
                @csrf
                <strong style="font-size: 12px; color: #534085; display: block; margin-bottom: 8px;">➕ Daftarkan Pengurus / Admin Baru</strong>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama pengurus" required>
                    </div>
                    <div class="form-group">
                        <label>Email Login</label>
                        <input type="email" name="email" class="form-control" placeholder="email@rengkuhan.org" required>
                    </div>
                    <div class="form-group">
                        <label>Password Awal</label>
                        <input type="password" name="password" class="form-control" placeholder="Min. 6 karakter" required>
                    </div>
                    <div class="form-group">
                        <label>Role Jabatan</label>
                        <select name="jabatan" class="form-control" required>
                            <option value="Pengurus">Pengurus</option>
                            <option value="Administrator">Administrator</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP/WA</label>
                        <input type="text" name="no_telpon" class="form-control" placeholder="08xxxxxxxxxx">
                    </div>
                </div>
                <button type="submit" class="btn-primary">+ Tambah Akun</button>
            </form>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>No. Telpon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mandalaList as $m)
                            <tr>
                                <td><strong>{{ $m->Nama }}</strong></td>
                                <td>{{ $m->Email }}</td>
                                <td>
                                    <span class="badge {{ $m->Jabatan === 'Administrator' ? 'badge-danger' : 'badge-info' }}">
                                        {{ $m->Jabatan ?? 'Pengurus' }}
                                    </span>
                                </td>
                                <td>{{ $m->No_Telpon ?? '-' }}</td>
                                <td>
                                    @if($m->ID_Mandala != session('auth_id'))
                                        <form method="POST" action="{{ route('admin.mandala.destroy', $m->ID_Mandala) }}" style="display:inline;" onsubmit="return confirm('Hapus akun ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-danger-sm">Hapus</button>
                                        </form>
                                    @else
                                        <span style="font-size: 11px; color: #887ba5;">(Sedang Aktif)</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MANAJEMEN VOLUNTEER -->
        <div class="card" id="kelola-volunteer">
            <h3>
                <span>🤝 Daftar Relawan Terdaftar</span>
            </h3>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Relawan</th>
                            <th>Email</th>
                            <th>Nomor Telepon / WA</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($volunteerList as $vol)
                            <tr>
                                <td><strong>{{ $vol->Nama }}</strong></td>
                                <td>{{ $vol->Email }}</td>
                                <td>{{ $vol->No_Telpon ?? '-' }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.volunteer.destroy', $vol->ID_Volunteer) }}" style="display:inline;" onsubmit="return confirm('Hapus relawan ini? Seluruh data pendaftarannya akan terhapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-danger-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- CHART OF ACCOUNTS & HISTORI KEUANGAN -->
        <div class="card" id="keuangan-coa">
            <h3>
                <span>📊 Chart of Accounts (COA) & Kas Keuangan</span>
            </h3>

            <!-- Form Tambah COA -->
            <form method="POST" action="{{ route('admin.coa.store') }}" style="background: #faf8fe; padding: 14px; border-radius: 8px; margin-bottom: 16px; border: 1px solid #eae2f8;">
                @csrf
                <strong style="font-size: 12px; color: #534085; display: block; margin-bottom: 8px;">➕ Tambah Akun Akuntansi (COA)</strong>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Akun</label>
                        <input type="text" name="nama_akun" class="form-control" placeholder="Contoh: Beban Konsumsi" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Akun</label>
                        <input type="text" name="jenis_akun" class="form-control" placeholder="Contoh: Beban / Aset / Pendapatan" required>
                    </div>
                    <div class="form-group">
                        <label>Posisi Normal</label>
                        <select name="posisi" class="form-control" required>
                            <option value="Debit">Debit</option>
                            <option value="Kredit">Kredit</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn-primary">+ Simpan Akun COA</button>
            </form>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Akun</th>
                            <th>Jenis Akun</th>
                            <th>Posisi Normal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coaList as $c)
                            <tr>
                                <td>#{{ $c->ID_Akun }}</td>
                                <td><strong>{{ $c->Nama_Akun }}</strong></td>
                                <td>{{ $c->Jenis_Akun }}</td>
                                <td>
                                    <span class="badge {{ $c->Posisi === 'Debit' ? 'badge-info' : 'badge-warning' }}">
                                        {{ $c->Posisi }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

</body>
</html>
