<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Generate RAB dengan AI | Ranah Rengkuh</title>

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

/* 2 KOLOM GRID FIGMA */
.ai-rab-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.8fr) minmax(320px, 1fr);
    gap: 24px;
    align-items: start;
}

/* CARD FORM KIRI FIGMA */
.ai-form-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.04);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #4b387e;
    margin-bottom: 8px;
}

.ai-select, .ai-textarea {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #dcd3ee;
    font-size: 13px;
    color: #3b2a68;
    background: #ffffff;
    outline: none;
    transition: border-color .2s;
}

.ai-select:focus, .ai-textarea:focus {
    border-color: #5d4692;
    box-shadow: 0 0 0 3px rgba(93, 70, 146, 0.12);
}

.btn-generate-ai {
    width: 100%;
    padding: 14px;
    background: #5d4692;
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(93, 70, 146, 0.25);
    transition: background .2s;
}

.btn-generate-ai:hover {
    background: #4b367d;
}

.ai-disclaimer {
    margin-top: 14px;
    font-size: 11px;
    color: #8c80a8;
    text-align: center;
}

/* CARD PREVIEW KANAN FIGMA */
.preview-card {
    background: #ffffff;
    border: 1px solid #ebe4f7;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 18px rgba(60, 45, 110, 0.04);
}

.preview-card h3 {
    margin: 0 0 8px;
    font-size: 17px;
    font-weight: 800;
    color: #3b2a68;
}

.preview-meta {
    font-size: 12px;
    color: #7d7099;
    margin-bottom: 20px;
}

.empty-ai-box {
    background: #f8f6fd;
    border-radius: 12px;
    padding: 24px 20px;
    text-align: center;
}

.empty-ai-box strong {
    display: block;
    font-size: 14px;
    color: #55447a;
    margin-bottom: 8px;
}

.empty-ai-box p {
    margin: 0;
    font-size: 12px;
    color: #8c80a8;
    line-height: 1.5;
}

/* HASIL REKOMENDASI AI */
.rekomendasi-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
    margin-bottom: 16px;
}

.rekomendasi-table th {
    background: #f7f5fd;
    padding: 8px 10px;
    text-align: left;
    color: #554580;
    border-bottom: 1px solid #e8e2f6;
}

.rekomendasi-table td {
    padding: 8px 10px;
    border-bottom: 1px solid #f2edf8;
    color: #433669;
}

.btn-simpan-rab {
    width: 100%;
    padding: 12px;
    background: #17834a;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
}

@media(max-width: 900px) {
    .ai-rab-grid { grid-template-columns: 1fr; }
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
        <a href="{{ route('pengurus.laporan.pendaftar') }}">
            <span>📋</span> Laporan Pendaftar
        </a>
        <a href="{{ route('pengurus.rekap.pembayaran') }}">
            <span>💳</span> Rekap Pembayaran
        </a>
        <a href="{{ route('pengurus.generate.rab.ai') }}" class="active">
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
            <span>Manajemen / </span> Generate RAB dengan AI
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

        <h1 class="page-title">Generate RAB dengan AI</h1>
        <p class="page-subtitle">Susun rekomendasi anggaran kegiatan otomatis, lalu periksa kembali sebelum disimpan.</p>

        <div class="ai-rab-grid">

            <!-- FORM GENERATOR KIRI FIGMA -->
            <div class="ai-form-card">
                <form method="POST" action="{{ route('pengurus.generate.rab.ai.post') }}">
                    @csrf

                    <div class="form-group">
                        <label>Pilih kegiatan</label>
                        <select name="kegiatan_id" class="ai-select" onchange="window.location.href='{{ route('pengurus.generate.rab.ai') }}?kegiatan_id=' + this.value">
                            @foreach($kegiatanList as $k)
                                <option value="{{ $k->ID_Kegiatan }}" {{ ($kegiatan->ID_Kegiatan ?? null) == $k->ID_Kegiatan ? 'selected' : '' }}>
                                    {{ $k->Nama_Kegiatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi kebutuhan kegiatan</label>
                        <textarea name="deskripsi_kebutuhan" rows="3" class="ai-textarea" placeholder="Contoh: Pendampingan belajar bagi anak binaan dengan dukungan 20 volunteer di Semarang. Siapkan konsumsi, alat tulis, buku bacaan, dan transportasi.">{{ old('deskripsi_kebutuhan', $kegiatan->Deskripsi ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Catatan kebutuhan biaya khusus</label>
                        <textarea name="catatan_biaya" rows="4" class="ai-textarea" placeholder="Konsumsi: 20 porsi&#10;Alat tulis: 20 paket&#10;Buku bacaan: 10 buah&#10;Transportasi: 1 perjalanan">Konsumsi: {{ $kegiatan->Kuota ?? 20 }} porsi
Alat tulis: {{ $kegiatan->Kuota ?? 20 }} paket
Buku bacaan: 15 buah
Transportasi & Operasional</textarea>
                    </div>

                    <button type="submit" class="btn-generate-ai">
                        ✨ Generate RAB dengan AI
                    </button>

                    <div class="ai-disclaimer">
                        Rekomendasi AI bukan anggaran final. Harga dan jumlah kebutuhan tetap perlu diperiksa oleh MANDALA.
                    </div>
                </form>
            </div>

            <!-- PREVIEW KANAN FIGMA -->
            <div class="preview-card">
                @if($kegiatan)
                    <h3>{{ $kegiatan->Nama_Kegiatan }}</h3>
                    <div class="preview-meta">
                        {{ $kegiatan->Kategori ?? 'Pendidikan' }} • {{ \Carbon\Carbon::parse($kegiatan->Tanggal_Kegiatan)->translatedFormat('d F Y') }} • {{ $kegiatan->Lokasi ?? 'Semarang' }}<br>
                        Kuota {{ $kegiatan->Kuota }} volunteer • {{ $kegiatan->pendaftaran->count() }} pendaftar
                    </div>

                    @if($rekomendasi)
                        @php $totalAi = 0; @endphp
                        <form method="POST" action="{{ route('pengurus.simpan.rekomendasi.rab', $kegiatan->ID_Kegiatan) }}">
                            @csrf
                            <table class="rekomendasi-table">
                                <thead>
                                    <tr>
                                        <th>Kebutuhan</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rekomendasi as $idx => $r)
                                        @php $totalAi += $r['total']; @endphp
                                        <tr>
                                            <td>
                                                <input type="hidden" name="items[{{ $idx }}][kebutuhan]" value="{{ $r['kebutuhan'] }}">
                                                <input type="hidden" name="items[{{ $idx }}][harga]" value="{{ $r['harga'] }}">
                                                <input type="hidden" name="items[{{ $idx }}][qty]" value="{{ $r['qty'] }}">
                                                {{ $r['kebutuhan'] }}
                                            </td>
                                            <td>{{ $r['qty'] }}</td>
                                            <td>Rp{{ number_format($r['total'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr style="font-weight: 800; background: #f8f6fd;">
                                        <td colspan="2">Total Estimasi AI</td>
                                        <td>Rp{{ number_format($totalAi, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <button type="submit" class="btn-simpan-rab">
                                ✓ Simpan Rekomendasi ke RAB
                            </button>
                        </form>
                    @else
                        <div class="empty-ai-box">
                            <strong>Belum ada rekomendasi</strong>
                            <p>Lengkapi kebutuhan kegiatan di sebelah kiri, kemudian pilih <em>Generate RAB dengan AI</em> untuk melihat estimasi anggaran cerdas.</p>
                        </div>
                    @endif
                @endif
            </div>

        </div>

    </div>
</main>

</body>
</html>
