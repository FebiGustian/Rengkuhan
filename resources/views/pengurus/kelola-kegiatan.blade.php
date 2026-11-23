<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Kegiatan | Ranah Rengkuh</title>

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

/* FILTER BAR FIGMA */
.filter-bar {
    display: flex;
    gap: 14px;
    align-items: flex-end;
    margin-bottom: 22px;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.filter-group label {
    font-size: 12px;
    font-weight: 700;
    color: #4b3977;
}

.filter-input, .filter-select {
    padding: 11px 14px;
    border-radius: 10px;
    border: 1px solid #dcd3ee;
    font-size: 13px;
    color: #3b2a68;
    background: #ffffff;
    outline: none;
}

.filter-input { width: 280px; }
.filter-select { width: 200px; }

.btn-tambah {
    margin-left: auto;
    padding: 12px 22px;
    background: #5d4692;
    color: #ffffff;
    border: none;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(93, 70, 146, 0.2);
    transition: background .2s;
}

.btn-tambah:hover { background: #4a357b; }

/* CARD TABLE FIGMA */
.table-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.04);
}

.table-header-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.table-header-meta strong {
    font-size: 15px;
    color: #3b2a68;
}

.table-header-meta a {
    font-size: 12px;
    color: #6a5a8e;
    text-decoration: none;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

th {
    background: #f7f5fd;
    color: #554580;
    text-align: left;
    padding: 12px 14px;
    border-bottom: 2px solid #eae2f8;
    font-weight: 700;
}

td {
    padding: 14px;
    border-bottom: 1px solid #f3effb;
    color: #4b3d73;
    vertical-align: middle;
}

tr:hover td { background: #faf9fe; }

.status-aktif { color: #17834a; font-weight: 700; }
.status-selesai { color: #857b9e; font-weight: 600; }

.actions a, .actions button {
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    background: none;
    border: none;
    cursor: pointer;
    margin-right: 8px;
}

.btn-link-detail { color: #5d4692; }
.btn-link-edit { color: #5d4692; }
.btn-link-hapus { color: #d03030; }

.footnote-meta {
    font-size: 11px;
    color: #9287ae;
    margin-top: 18px;
}

@media(max-width: 900px) {
    .filter-bar { flex-direction: column; align-items: stretch; }
    .filter-input, .filter-select { width: 100%; }
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
            <span>Manajemen / </span> Kelola Kegiatan
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

        <h1 class="page-title">Kelola Kegiatan</h1>
        <p class="page-subtitle">Atur informasi, kuota, dan biaya pendaftaran kegiatan volunteer.</p>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 12px 18px; border-radius: 9px; margin-bottom: 18px; font-size: 13px;">
                ✓ {{ session('success') }}
            </div>
        @endif

        <!-- FILTER BAR FIGMA -->
        <form method="GET" action="{{ route('pengurus.kegiatan.index') }}" class="filter-bar">
            <div class="filter-group">
                <label>Pencarian</label>
                <input type="text" name="search" value="{{ $search ?? '' }}" class="filter-input" placeholder="Cari nama kegiatan...">
            </div>

            <div class="filter-group">
                <label>Kategori</label>
                <select name="kategori" class="filter-select" onchange="this.form.submit()">
                    <option value="Semua kategori" {{ ($kategori ?? '') == 'Semua kategori' ? 'selected' : '' }}>Semua kategori</option>
                    <option value="Pendidikan" {{ ($kategori ?? '') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    <option value="Lingkungan" {{ ($kategori ?? '') == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                    <option value="Sosial" {{ ($kategori ?? '') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                </select>
            </div>

            <a href="{{ route('pengurus.kegiatan.tambah') }}" class="btn-tambah">
                + Tambah Kegiatan
            </a>
        </form>

        <!-- TABLE CARD FIGMA -->
        <div class="table-card">
            <div class="table-header-meta">
                <strong>{{ $kegiatanList->count() }} kegiatan</strong>
                <a href="{{ route('pengurus.kegiatan.index') }}">Reset Filter</a>
            </div>

            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Nama kegiatan</th>
                            <th>Kategori</th>
                            <th>Jadwal & lokasi</th>
                            <th>Kuota</th>
                            <th>Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatanList as $keg)
                            @php
                                $isSelesai = \Carbon\Carbon::parse($keg->Tanggal_Kegiatan)->isPast();
                            @endphp
                            <tr>
                                <td><strong>{{ $keg->Nama_Kegiatan }}</strong></td>
                                <td>{{ $keg->Kategori ?? 'Pendidikan' }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($keg->Tanggal_Kegiatan)->translatedFormat('d M Y') }}<br>
                                    <small style="color: #7b6f98;">{{ $keg->Lokasi ?? 'Semarang' }}</small>
                                </td>
                                <td>{{ $keg->pendaftaran_count }} / {{ $keg->Kuota }}</td>
                                <td>Rp{{ number_format($keg->Biaya ?? 50000, 0, ',', '.') }}</td>
                                <td>
                                    @if($isSelesai)
                                        <span class="status-selesai">Selesai</span>
                                    @else
                                        <span class="status-aktif">Aktif</span>
                                    @endif
                                </td>
                                <td class="actions">
                                    <a href="{{ route('volunteer.kegiatan.detail', $keg->ID_Kegiatan) }}" target="_blank" class="btn-link-detail">Lihat Detail</a>
                                    <form method="POST" action="{{ route('pengurus.kegiatan.destroy', $keg->ID_Kegiatan) }}" style="display:inline;" onsubmit="return confirm('Hapus kegiatan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-link-hapus">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 24px; color: #8e82ad;">
                                    Tidak ada kegiatan yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="footnote-meta">
                Data pengelolaan kegiatan. Kuota menunjukkan pendaftar / kapasitas.
            </div>
        </div>

    </div>
</main>

</body>
</html>
