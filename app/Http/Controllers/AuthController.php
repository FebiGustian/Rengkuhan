<?php

namespace App\Http\Controllers;

use App\Models\Mandala;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRoleSelection()
    {
        return view('home');
    }

    public function selectRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:mandala,volunteer',
        ]);

        return redirect('/login/' . $request->role);
    }

    public function showLogin(string $role)
    {
        abort_unless(in_array($role, ['mandala', 'volunteer']), 404);
        $roleLabel = $role === 'mandala' ? 'Pengurus / Admin' : 'Volunteer';

        return view('login', compact('roleLabel', 'role'));
    }

    public function login(Request $request, string $role)
    {
        abort_unless(in_array($role, ['mandala', 'volunteer']), 404);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($role === 'mandala') {
            $user = Mandala::where('Email', $request->email)->first();
            $idField = 'ID_Mandala';
        } else {
            $user = Volunteer::where('Email', $request->email)->first();
            $idField = 'ID_Volunteer';
        }

        if (!$user || !Hash::check($request->password, $user->Password)) {
            return back()->withErrors([
                'login' => 'Email atau password yang kamu masukkan salah.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $jabatan = $role === 'mandala' ? ($user->Jabatan ?? 'Pengurus') : 'Volunteer';

        session([
            'auth_role' => $role,
            'auth_id' => $user->$idField,
            'auth_name' => $user->Nama,
            'auth_email' => $user->Email,
            'auth_jabatan' => $jabatan,
        ]);

        if ($role === 'mandala' && $jabatan === 'Administrator') {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, Admin!');
        }

        if ($role === 'mandala') {
            return redirect()->route('pengurus.dashboard')->with('success', 'Selamat datang kembali di Dashboard Pengurus!');
        }

        return redirect()->route('volunteer.dashboard')->with('success', 'Selamat datang kembali di Komunitas Rengkuhan!');
    }

    public function showRegisterVolunteer()
    {
        return view('register', [
            'role' => 'volunteer',
            'roleLabel' => 'Volunteer',
        ]);
    }

    public function registerVolunteer(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:volunteer,Email',
            'no_telpon' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'no_telpon.required' => 'Nomor WhatsApp / telepon wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        Volunteer::create([
            'Nama' => $validated['nama'],
            'Email' => $validated['email'],
            'No_Telpon' => $validated['no_telpon'],
            'Password' => Hash::make($validated['password']),
        ]);

        return redirect('/login/volunteer')
            ->with('success', 'Pendaftaran akun volunteer berhasil! Silakan masuk dengan akun kamu.');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('info', 'Kamu telah berhasil keluar.');
    }
}
