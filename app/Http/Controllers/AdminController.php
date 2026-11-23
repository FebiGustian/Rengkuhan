<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\Kegiatan;
use App\Models\Mandala;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $adminId = session('auth_id');
        $admin = Mandala::findOrFail($adminId);

        $totalMandala = Mandala::count();
        $totalVolunteer = Volunteer::count();
        $totalKegiatan = Kegiatan::count();
        $totalPendaftaran = Pendaftaran::count();
        $totalKas = Pembayaran::where('Status', 'Lunas')->sum('Nominal');

        $mandalaList = Mandala::orderBy('ID_Mandala', 'desc')->get();
        $volunteerList = Volunteer::orderBy('ID_Volunteer', 'desc')->take(20)->get();
        $pembayaranList = Pembayaran::with(['pendaftaran.volunteer', 'pendaftaran.kegiatan'])
            ->orderBy('ID_Pembayaran', 'desc')
            ->take(15)
            ->get();
        $coaList = Coa::orderBy('ID_Akun', 'asc')->get();

        return view('dashboard-admin', [
            'admin' => $admin,
            'nama' => session('auth_name'),
            'totalMandala' => $totalMandala,
            'totalVolunteer' => $totalVolunteer,
            'totalKegiatan' => $totalKegiatan,
            'totalPendaftaran' => $totalPendaftaran,
            'totalKas' => $totalKas,
            'mandalaList' => $mandalaList,
            'volunteerList' => $volunteerList,
            'pembayaranList' => $pembayaranList,
            'coaList' => $coaList,
        ]);
    }

    public function storeMandala(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:mandala,Email',
            'password' => 'required|string|min:6',
            'jabatan' => 'required|in:Pengurus,Administrator',
            'no_telpon' => 'nullable|string|max:20',
        ]);

        Mandala::create([
            'Nama' => $validated['nama'],
            'Email' => $validated['email'],
            'Password' => Hash::make($validated['password']),
            'Jabatan' => $validated['jabatan'],
            'No_Telpon' => $validated['no_telpon'] ?? null,
        ]);

        return back()->with('success', 'Akun pengurus baru berhasil ditambahkan!');
    }

    public function destroyMandala(int $id)
    {
        if ($id == session('auth_id')) {
            return back()->with('error', 'Kamu tidak dapat menghapus akun admin yang sedang login.');
        }

        $mandala = Mandala::findOrFail($id);
        $mandala->delete();

        return back()->with('success', 'Akun pengurus berhasil dihapus.');
    }

    public function destroyVolunteer(int $id)
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->delete();

        return back()->with('success', 'Data volunteer berhasil dihapus.');
    }

    public function storeCoa(Request $request)
    {
        $validated = $request->validate([
            'nama_akun' => 'required|string|max:100',
            'jenis_akun' => 'required|string|max:50',
            'posisi' => 'required|in:Debit,Kredit',
        ]);

        Coa::create([
            'Nama_Akun' => $validated['nama_akun'],
            'Jenis_Akun' => $validated['jenis_akun'],
            'Posisi' => $validated['posisi'],
        ]);

        return back()->with('success', 'Akun COA baru berhasil disimpan!');
    }
}
