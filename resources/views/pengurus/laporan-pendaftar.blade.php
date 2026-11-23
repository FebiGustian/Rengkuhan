<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Pendaftar | Ranah Rengkuh</title>

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

/* TABLE CARD FIGMA */
.table-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.04);
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

.status-badge {
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
}

.status-lunas { background: #e2f7ec; color: #17834a; }
.status-menunggu { background: #fff4d9; color: #925c04; }

.btn-detail {
    color: #5d4692;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
}

@media(max-width: 900px) {
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
            <span>Manajemen / </span> Laporan Pendaftar
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

        <h1 class="page-title">Laporan Pendaftar Kegiatan</h1>
        <p class="page-subtitle">Daftar seluruh volunteer yang mendaftar ke program kerelawanan Ranah Rengkuh.</p>

        <div class="table-card">
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Nomor Pendaftaran</th>
                            <th>Nama Volunteer</th>
                            <th>Kegiatan</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftaranList as $p)
                            @php
                                $status = $p->pembayaran->first()->Status ?? 'Menunggu';
                                $regNo = 'RR-REG-' . date('Ymd', strtotime($p->Tanggal_Pendaftaran)) . '-' . str_pad($p->ID_Pendaftaran, 3, '0', STR_PAD_LEFT);
                            @endphp
                            <tr>
                                <td><strong>{{ $regNo }}</strong></td>
                                <td>{{ $p->volunteer->Nama ?? '-' }}</td>
                                <td>{{ $p->kegiatan->Nama_Kegiatan ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->Tanggal_Pendaftaran)->translatedFormat('d M Y') }}</td>
                                <td>
                                    @if($status === 'Lunas')
                                        <span class="status-badge status-lunas">Terdaftar (Lunas)</span>
                                    @else
                                        <span class="status-badge status-menunggu">Menunggu pembayaran</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('pengurus.detail.pendaftar', $p->ID_Pendaftaran) }}" class="btn-detail">Lihat Detail →</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 24px; color: #8e82ad;">
                                    Belum ada data pendaftaran masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

</body>
</html>
