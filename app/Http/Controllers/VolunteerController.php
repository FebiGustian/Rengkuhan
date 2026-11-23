<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VolunteerController extends Controller
{
    public function dashboard(Request $request)
    {
        $volunteerId = session('auth_id');
        $volunteer = Volunteer::findOrFail($volunteerId);

        $pendaftaranList = Pendaftaran::with(['kegiatan.mandala', 'pembayaran'])
            ->where('ID_Volunteer', $volunteerId)
            ->orderBy('Tanggal_Pendaftaran', 'desc')
            ->get();

        $registeredKegiatanIds = $pendaftaranList->pluck('ID_Kegiatan')->toArray();

        $kegiatanTersedia = Kegiatan::with('mandala')
            ->withCount('pendaftaran')
            ->where('Tanggal_Kegiatan', '>=', now()->toDateString())
            ->orderBy('Tanggal_Kegiatan', 'asc')
            ->get();

        $riwayatKegiatan = Pendaftaran::with('kegiatan')
            ->where('ID_Volunteer', $volunteerId)
            ->whereHas('kegiatan', function ($q) {
                $q->where('Tanggal_Kegiatan', '<', now()->toDateString());
            })
            ->get();

        $totalDiikuti = $pendaftaranList->count();
        $totalSelesai = $riwayatKegiatan->count();
        $menungguPembayaran = Pembayaran::whereHas('pendaftaran', function ($q) use ($volunteerId) {
            $q->where('ID_Volunteer', $volunteerId);
        })->whereIn('Status', ['Menunggu', 'Menunggu Verifikasi'])->count();

        return view('dashboard', [
            'roleLabel' => 'Volunteer',
            'volunteer' => $volunteer,
            'nama' => session('auth_name'),
            'pendaftaranList' => $pendaftaranList,
            'registeredKegiatanIds' => $registeredKegiatanIds,
            'kegiatanTersedia' => $kegiatanTersedia,
            'riwayatKegiatan' => $riwayatKegiatan,
            'totalDiikuti' => $totalDiikuti,
            'totalSelesai' => $totalSelesai,
            'menungguPembayaran' => $menungguPembayaran,
        ]);
    }

    // HALAMAN DETAIL KEGIATAN (FIGMA)
    public function detailKegiatan(int $idKegiatan)
    {
        $volunteerId = session('auth_id');
        $kegiatan = Kegiatan::with(['mandala', 'pendaftaran'])->findOrFail($idKegiatan);

        $registeredKegiatanIds = Pendaftaran::where('ID_Volunteer', $volunteerId)
            ->pluck('ID_Kegiatan')
            ->toArray();

        return view('volunteer.detail-kegiatan', [
            'kegiatan' => $kegiatan,
            'registeredKegiatanIds' => $registeredKegiatanIds,
            'nama' => session('auth_name'),
        ]);
    }

    // FORMULIR PENDAFTARAN (FIGMA)
    public function formDaftarKegiatan(int $idKegiatan)
    {
        $volunteerId = session('auth_id');
        $volunteer = Volunteer::findOrFail($volunteerId);
        $kegiatan = Kegiatan::withCount('pendaftaran')->findOrFail($idKegiatan);

        $already = Pendaftaran::where('ID_Volunteer', $volunteerId)
            ->where('ID_Kegiatan', $idKegiatan)
            ->first();

        if ($already) {
            $pembayaran = Pembayaran::where('ID_Pendaftaran', $already->ID_Pendaftaran)->first();
            if ($pembayaran) {
                return redirect()->route('volunteer.pembayaran.instruksi', $pembayaran->ID_Pembayaran);
            }
            return redirect()->route('volunteer.dashboard')->with('info', 'Kamu sudah terdaftar di kegiatan ini.');
        }

        return view('volunteer.formulir-pendaftaran', [
            'kegiatan' => $kegiatan,
            'volunteer' => $volunteer,
            'nama' => session('auth_name'),
        ]);
    }

    // SUBMIT PENDAFTARAN DARI FORMULIR (FIGMA)
    public function submitDaftarKegiatan(Request $request, int $idKegiatan)
    {
        $volunteerId = session('auth_id');
        $kegiatan = Kegiatan::withCount('pendaftaran')->findOrFail($idKegiatan);

        if ($kegiatan->pendaftaran_count >= $kegiatan->Kuota) {
            return back()->with('error', 'Mohon maaf, kuota kegiatan ini sudah penuh.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'no_telpon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'motivasi' => 'required|string',
            'pengalaman' => 'nullable|string',
        ]);

        $volunteer = Volunteer::findOrFail($volunteerId);
        $volunteer->update([
            'Nama' => $validated['nama'],
            'No_Telpon' => $validated['no_telpon'],
        ]);
        session(['auth_name' => $volunteer->Nama]);

        $pembayaranId = DB::transaction(function () use ($volunteerId, $idKegiatan, $validated, $kegiatan) {
            $pendaftaran = Pendaftaran::create([
                'ID_Volunteer' => $volunteerId,
                'ID_Kegiatan' => $idKegiatan,
                'Tanggal_Pendaftaran' => now()->toDateString(),
                'Alamat' => $validated['alamat'],
                'Motivasi' => $validated['motivasi'],
                'Pengalaman' => $validated['pengalaman'] ?? null,
            ]);

            $pembayaran = Pembayaran::create([
                'ID_Pendaftaran' => $pendaftaran->ID_Pendaftaran,
                'Nominal' => $kegiatan->Biaya ?? 50000,
                'Metode_Pembayaran' => 'QRIS',
                'Status' => 'Menunggu',
            ]);

            return $pembayaran->ID_Pembayaran;
        });

        // Diarahkan langsung ke halaman Pilih Metode Pembayaran Figma
        return redirect()->route('volunteer.pembayaran.metode', $pembayaranId)
            ->with('success', 'Pendaftaran berhasil dikirim! Silakan pilih metode pembayaran.');
    }

    // HALAMAN PILIH METODE PEMBAYARAN (FIGMA)
    public function pilihMetodePembayaran(int $idPembayaran)
    {
        $volunteerId = session('auth_id');
        $pembayaran = Pembayaran::with(['pendaftaran.kegiatan', 'pendaftaran.volunteer'])
            ->whereHas('pendaftaran', function ($q) use ($volunteerId) {
                $q->where('ID_Volunteer', $volunteerId);
            })
            ->findOrFail($idPembayaran);

        if ($pembayaran->Status === 'Lunas') {
            return redirect()->route('volunteer.pembayaran.sukses', $pembayaran->ID_Pembayaran);
        }

        return view('volunteer.pilih-metode-pembayaran', [
            'pembayaran' => $pembayaran,
            'pendaftaran' => $pembayaran->pendaftaran,
            'nama' => session('auth_name'),
        ]);
    }

    // PROSES PILIHAN METODE KE INSTRUKSI
    public function prosesPilihanMetode(Request $request, int $idPembayaran)
    {
        $volunteerId = session('auth_id');
        $pembayaran = Pembayaran::whereHas('pendaftaran', function ($q) use ($volunteerId) {
            $q->where('ID_Volunteer', $volunteerId);
        })->findOrFail($idPembayaran);

        $pembayaran->update([
            'Metode_Pembayaran' => $request->metode ?? 'QRIS',
        ]);

        return redirect()->route('volunteer.pembayaran.instruksi', $pembayaran->ID_Pembayaran);
    }

    // HALAMAN INSTRUKSI PEMBAYARAN (FIGMA)
    public function instruksiPembayaran(int $idPembayaran)
    {
        $volunteerId = session('auth_id');
        $pembayaran = Pembayaran::with(['pendaftaran.kegiatan', 'pendaftaran.volunteer'])
            ->whereHas('pendaftaran', function ($q) use ($volunteerId) {
                $q->where('ID_Volunteer', $volunteerId);
            })
            ->findOrFail($idPembayaran);

        if ($pembayaran->Status === 'Lunas') {
            return redirect()->route('volunteer.pembayaran.sukses', $pembayaran->ID_Pembayaran);
        }

        return view('volunteer.instruksi-pembayaran', [
            'pembayaran' => $pembayaran,
            'pendaftaran' => $pembayaran->pendaftaran,
            'nama' => session('auth_name'),
        ]);
    }

    // SIMULASI PEMBAYARAN SUKSES (MIDTRANS GATEWAY SIMULATOR)
    public function simulasiPembayaranSukses(int $idPembayaran)
    {
        $volunteerId = session('auth_id');
        $pembayaran = Pembayaran::whereHas('pendaftaran', function ($q) use ($volunteerId) {
            $q->where('ID_Volunteer', $volunteerId);
        })->findOrFail($idPembayaran);

        $pembayaran->update([
            'Status' => 'Lunas',
        ]);

        return redirect()->route('volunteer.pembayaran.sukses', $pembayaran->ID_Pembayaran)
            ->with('success', 'Pembayaran berhasil dikonfirmasi secara instan!');
    }

    // HALAMAN STRUK PEMBAYARAN BERHASIL (FIGMA)
    public function pembayaranBerhasil(int $idPembayaran)
    {
        $volunteerId = session('auth_id');
        $pembayaran = Pembayaran::with(['pendaftaran.kegiatan', 'pendaftaran.volunteer'])
            ->whereHas('pendaftaran', function ($q) use ($volunteerId) {
                $q->where('ID_Volunteer', $volunteerId);
            })
            ->findOrFail($idPembayaran);

        return view('volunteer.pembayaran-berhasil', [
            'pembayaran' => $pembayaran,
            'pendaftaran' => $pembayaran->pendaftaran,
            'nama' => session('auth_name'),
        ]);
    }

    // ROUTE MENU "PEMBAYARAN" DI SIDEBAR
    public function halamanPembayaran()
    {
        $volunteerId = session('auth_id');
        $pembayaranTerbaru = Pembayaran::whereHas('pendaftaran', function ($q) use ($volunteerId) {
            $q->where('ID_Volunteer', $volunteerId);
        })
        ->orderBy('ID_Pembayaran', 'desc')
        ->first();

        if ($pembayaranTerbaru) {
            return redirect()->route('volunteer.pembayaran.instruksi', $pembayaranTerbaru->ID_Pembayaran);
        }

        return redirect()->route('volunteer.dashboard')->with('info', 'Belum ada tagihan pembayaran aktif.');
    }

    // ROUTE MENU "RIWAYAT" DI SIDEBAR
    public function halamanRiwayat()
    {
        return redirect()->route('volunteer.dashboard')->with('info', 'Lihat daftar kegiatan yang kamu ikuti di bagian "Kegiatan Saya".');
    }

    public function konfirmasiPembayaran(Request $request, int $idPembayaran)
    {
        $volunteerId = session('auth_id');
        $pembayaran = Pembayaran::whereHas('pendaftaran', function ($q) use ($volunteerId) {
            $q->where('ID_Volunteer', $volunteerId);
        })->findOrFail($idPembayaran);

        $pembayaran->update([
            'Metode_Pembayaran' => $request->metode ?? 'QRIS',
            'Status' => 'Menunggu Verifikasi',
        ]);

        return back()->with('success', 'Konfirmasi pembayaran berhasil dikirim! Menunggu verifikasi pengurus.');
    }

    public function updateProfil(Request $request)
    {
        $volunteerId = session('auth_id');
        $volunteer = Volunteer::findOrFail($volunteerId);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'no_telpon' => 'required|string|max:20',
        ]);

        $volunteer->update([
            'Nama' => $validated['nama'],
            'No_Telpon' => $validated['no_telpon'],
        ]);

        session(['auth_name' => $volunteer->Nama]);

        return back()->with('success', 'Profil kamu berhasil diperbarui!');
    }
}
