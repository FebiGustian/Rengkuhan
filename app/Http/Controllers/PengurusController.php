<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Mandala;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Rab;
use App\Models\DetailRab;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengurusController extends Controller
{
    // 1. DASHBOARD MANAJEMEN FIGMA
    public function dashboard()
    {
        $mandalaId = session('auth_id');
        $pengurus = Mandala::findOrFail($mandalaId);

        $kegiatanList = Kegiatan::withCount('pendaftaran')
            ->orderBy('Tanggal_Kegiatan', 'asc')
            ->get();

        $kegiatanAkanDatang = $kegiatanList->where('Tanggal_Kegiatan', '>=', now()->toDateString())->first() ?? $kegiatanList->first();

        $pendaftaranTerbaru = Pendaftaran::with(['volunteer', 'kegiatan', 'pembayaran'])
            ->orderBy('Tanggal_Pendaftaran', 'desc')
            ->take(6)
            ->get();

        $totalKegiatan = $kegiatanList->count();
        $totalVolunteer = Volunteer::count();
        $totalPendaftaran = Pendaftaran::count();
        $sudahDiterima = Pembayaran::where('Status', 'Lunas')->sum('Nominal');
        $menungguPembayaran = Pembayaran::where('Status', '!=', 'Lunas')->sum('Nominal');
        $pembayaranBerhasilCount = Pembayaran::where('Status', 'Lunas')->count();
        $pembayaranMenungguCount = Pembayaran::where('Status', '!=', 'Lunas')->count();

        return view('dashboard-pengurus', [
            'pengurus' => $pengurus,
            'nama' => session('auth_name'),
            'totalKegiatan' => $totalKegiatan,
            'totalVolunteer' => $totalVolunteer,
            'totalPendaftaran' => $totalPendaftaran,
            'sudahDiterima' => $sudahDiterima,
            'menungguPembayaran' => $menungguPembayaran,
            'pembayaranBerhasilCount' => $pembayaranBerhasilCount,
            'pembayaranMenungguCount' => $pembayaranMenungguCount,
            'pendaftaranTerbaru' => $pendaftaranTerbaru,
            'kegiatanAkanDatang' => $kegiatanAkanDatang,
        ]);
    }

    // 2. KELOLA KEGIATAN FIGMA
    public function kelolaKegiatan(Request $request)
    {
        $query = Kegiatan::withCount('pendaftaran')->with('mandala');

        if ($request->filled('search')) {
            $query->where('Nama_Kegiatan', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori') && $request->kategori !== 'Semua kategori') {
            $query->where('Kategori', $request->kategori);
        }

        $kegiatanList = $query->orderBy('Tanggal_Kegiatan', 'desc')->get();

        return view('pengurus.kelola-kegiatan', [
            'kegiatanList' => $kegiatanList,
            'nama' => session('auth_name'),
            'search' => $request->search,
            'kategori' => $request->kategori,
        ]);
    }

    // 3. TAMBAH KEGIATAN (VIEW)
    public function formTambahKegiatan()
    {
        return view('pengurus.tambah-kegiatan', [
            'nama' => session('auth_name'),
        ]);
    }

    // STORE KEGIATAN
    public function storeKegiatan(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:150',
            'kategori' => 'required|string|max:50',
            'tanggal_kegiatan' => 'required|date',
            'waktu' => 'nullable|string|max:50',
            'lokasi' => 'required|string|max:100',
            'penyelenggara' => 'nullable|string|max:100',
            'kuota' => 'required|integer|min:1|max:1000',
            'biaya' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'aktivitas' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'perlengkapan' => 'nullable|string',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $mandalaId = session('auth_id');

        $fotoPath = null;
        if ($request->hasFile('foto_kegiatan')) {
            $fotoPath = $request->file('foto_kegiatan')->store('kegiatan', 'public');
        }

        DB::transaction(function () use ($validated, $mandalaId, $fotoPath) {
            $kegiatan = Kegiatan::create([
                'ID_Mandala' => $mandalaId,
                'Nama_Kegiatan' => $validated['nama_kegiatan'],
                'Kategori' => $validated['kategori'],
                'Tanggal_Kegiatan' => $validated['tanggal_kegiatan'],
                'Waktu' => $validated['waktu'] ?? '09.00 - 12.00 WIB',
                'Lokasi' => $validated['lokasi'],
                'Penyelenggara' => $validated['penyelenggara'] ?? 'Ranah Rengkuh',
                'Kuota' => $validated['kuota'],
                'Biaya' => $validated['biaya'],
                'Deskripsi' => $validated['deskripsi'] ?? null,
                'Tujuan' => $validated['tujuan'] ?? null,
                'Aktivitas' => $validated['aktivitas'] ?? null,
                'Persyaratan' => $validated['persyaratan'] ?? null,
                'Perlengkapan' => $validated['perlengkapan'] ?? null,
                'Foto_Kegiatan' => $fotoPath,
            ]);

            Rab::create([
                'ID_Kegiatan' => $kegiatan->ID_Kegiatan,
                'Tanggal' => now()->toDateString(),
            ]);
        });

        return redirect()->route('pengurus.kegiatan.index')
            ->with('success', 'Kegiatan baru berhasil dipublikasikan!');
    }

    // 4. KELOLA VOLUNTEER FIGMA
    public function kelolaVolunteer(Request $request)
    {
        $query = Volunteer::withCount('pendaftaran');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('Nama', 'like', '%' . $request->search . '%')
                  ->orWhere('Email', 'like', '%' . $request->search . '%');
            });
        }

        $volunteerList = $query->orderBy('ID_Volunteer', 'desc')->get();
        $totalVolunteer = Volunteer::count();
        $volunteerAktif = Volunteer::has('pendaftaran')->count();
        $volunteerNonAktif = $totalVolunteer - $volunteerAktif;

        return view('pengurus.kelola-volunteer', [
            'volunteerList' => $volunteerList,
            'totalVolunteer' => $totalVolunteer,
            'volunteerAktif' => $volunteerAktif,
            'volunteerNonAktif' => $volunteerNonAktif,
            'nama' => session('auth_name'),
            'search' => $request->search,
        ]);
    }

    // 5. LAPORAN PENDAFTAR FIGMA
    public function laporanPendaftar(Request $request)
    {
        $pendaftaranList = Pendaftaran::with(['volunteer', 'kegiatan', 'pembayaran'])
            ->orderBy('Tanggal_Pendaftaran', 'desc')
            ->get();

        return view('pengurus.laporan-pendaftar', [
            'pendaftaranList' => $pendaftaranList,
            'nama' => session('auth_name'),
        ]);
    }

    // DETAIL PENDAFTAR FIGMA
    public function detailPendaftar(int $idPendaftaran)
    {
        $pendaftaran = Pendaftaran::with(['volunteer', 'kegiatan', 'pembayaran'])->findOrFail($idPendaftaran);

        return view('pengurus.detail-pendaftar', [
            'pendaftaran' => $pendaftaran,
            'nama' => session('auth_name'),
        ]);
    }

    // 6. REKAP PEMBAYARAN FIGMA
    public function rekapPembayaran(Request $request)
    {
        $pembayaranList = Pembayaran::with(['pendaftaran.volunteer', 'pendaftaran.kegiatan'])
            ->orderBy('ID_Pembayaran', 'desc')
            ->get();

        $totalDiterima = Pembayaran::where('Status', 'Lunas')->sum('Nominal');
        $totalMenunggu = Pembayaran::where('Status', '!=', 'Lunas')->sum('Nominal');

        return view('pengurus.rekap-pembayaran', [
            'pembayaranList' => $pembayaranList,
            'totalDiterima' => $totalDiterima,
            'totalMenunggu' => $totalMenunggu,
            'nama' => session('auth_name'),
        ]);
    }

    // 7. GENERATE RAB DENGAN AI (FIGMA)
    public function generateRabAi(Request $request)
    {
        $kegiatanList = Kegiatan::with('rab.detailRab')->orderBy('Tanggal_Kegiatan', 'desc')->get();
        $selectedKegiatanId = $request->query('kegiatan_id', $kegiatanList->first()->ID_Kegiatan ?? null);
        $kegiatan = $selectedKegiatanId ? Kegiatan::with('rab.detailRab')->find($selectedKegiatanId) : null;

        $rekomendasi = null;
        if ($request->isMethod('post') && $kegiatan) {
            // Simulasi AI Generator RAB yang cerdas berdasarkan kuota & kebutuhan
            $kuota = $kegiatan->Kuota ?? 20;
            $rekomendasi = [
                ['kebutuhan' => 'Konsumsi & Snack Volunteer (' . $kuota . ' pax)', 'harga' => 25000, 'qty' => $kuota, 'total' => 25000 * $kuota],
                ['kebutuhan' => 'Paket Modul & Lembar Kerja Siswa', 'harga' => 15000, 'qty' => $kuota * 2, 'total' => 15000 * $kuota * 2],
                ['kebutuhan' => 'Alat Tulis & Crayon Mewarnai', 'harga' => 12000, 'qty' => $kuota, 'total' => 12000 * $kuota],
                ['kebutuhan' => 'Sewa Kendaraan & Transport Operasional', 'harga' => 350000, 'qty' => 1, 'total' => 350000],
                ['kebutuhan' => 'Kotak P3K & Sanitasi Kegiatan', 'harga' => 75000, 'qty' => 1, 'total' => 75000],
            ];
        }

        return view('pengurus.generate-rab-ai', [
            'kegiatanList' => $kegiatanList,
            'kegiatan' => $kegiatan,
            'rekomendasi' => $rekomendasi,
            'nama' => session('auth_name'),
        ]);
    }

    // SIMPAN REKOMENDASI AI KE RAB KEGIATAN
    public function simpanRekomendasiRab(Request $request, int $idKegiatan)
    {
        $kegiatan = Kegiatan::findOrFail($idKegiatan);
        $rab = Rab::firstOrCreate(['ID_Kegiatan' => $kegiatan->ID_Kegiatan], ['Tanggal' => now()->toDateString()]);

        $items = $request->input('items', []);
        foreach ($items as $item) {
            DetailRab::create([
                'ID_RAB' => $rab->ID_RAB,
                'Nama_Kebutuhan' => $item['kebutuhan'],
                'Harga_Satuan' => $item['harga'],
                'Kuantitas' => $item['qty'],
            ]);
        }

        return redirect()->route('pengurus.kegiatan.index')
            ->with('success', 'RAB hasil rekomendasi AI berhasil disimpan ke kegiatan!');
    }

    public function verifikasiPembayaran(Request $request, int $idPembayaran)
    {
        $pembayaran = Pembayaran::findOrFail($idPembayaran);
        $pembayaran->update([
            'Status' => $request->status,
        ]);

        return back()->with('success', 'Status pembayaran berhasil diubah menjadi: ' . $request->status);
    }

    public function destroyKegiatan(int $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return back()->with('success', 'Kegiatan berhasil dihapus.');
    }
}
