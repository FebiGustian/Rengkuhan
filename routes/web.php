<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('home');
});

Route::post('/pilih-role', function (Request $request) {
    $request->validate([
        'role' => 'required|in:mandala,volunteer',
    ]);

    return redirect('/login/' . $request->role);
});

Route::get('/login/{role}', function (string $role) {
    abort_unless(in_array($role, ['mandala', 'volunteer']), 404);

    $roleLabel = $role === 'mandala' ? 'Pengurus' : 'Volunteer';

    return view('login', compact('roleLabel', 'role'));
});

Route::post('/login/{role}', function (Request $request, string $role) {
    abort_unless(in_array($role, ['mandala', 'volunteer']), 404);

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $table = $role === 'mandala' ? 'mandala' : 'volunteer';

    $account = DB::table($table)
        ->where('Email', $request->email)
        ->first();

    if (!$account || !Hash::check($request->password, $account->Password)) {
        return back()->withErrors([
            'login' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    $idColumn = $role === 'mandala' ? 'ID_Mandala' : 'ID_Volunteer';

    $request->session()->regenerate();

    $jabatan = $role === 'mandala'
        ? $account->Jabatan
        : 'Volunteer';

    session([
        'auth_role' => $role,
        'auth_id' => $account->$idColumn,
        'auth_name' => $account->Nama,
        'auth_jabatan' => $jabatan,
    ]);

    if ($role === 'mandala' && $jabatan === 'Administrator') {
        return redirect('/dashboard/admin');
    }

    return redirect('/dashboard/' . $role);
});

Route::get('/dashboard/{role}', function (string $role) {
    abort_unless(in_array($role, ['admin', 'mandala', 'volunteer']), 404);

    if (!session('auth_id')) {
        return redirect('/');
    }

    $authRole = session('auth_role');
    $jabatan = session('auth_jabatan');

    if ($role === 'admin') {
        abort_unless(
            $authRole === 'mandala' && $jabatan === 'Administrator',
            403
        );

        return view('dashboard-admin', [
            'nama' => session('auth_name'),
        ]);
    }

    if ($role === 'mandala') {
        abort_unless(
            $authRole === 'mandala' && $jabatan === 'Pengurus',
            403
        );

        return view('dashboard-pengurus', [
            'nama' => session('auth_name'),
        ]);
    }

    abort_unless($authRole === 'volunteer', 403);

    return view('dashboard', [
        'roleLabel' => 'Volunteer',
        'nama' => session('auth_name'),
    ]);
});

Route::post('/logout', function (Request $request) {
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
});

// REGISTRASI VOLUNTEER
Route::get('/register/volunteer', function () {
    return view('register', [
        'role' => 'volunteer',
        'roleLabel' => 'Volunteer',
    ]);
});

Route::post('/register/volunteer', function (Request $request) {
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:volunteer,Email',
        'no_telpon' => 'required|string|max:20',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'nama.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',
        'no_telpon.required' => 'Nomor telepon wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    DB::table('volunteer')->insert([
        'Nama' => $validated['nama'],
        'Email' => $validated['email'],
        'No_Telpon' => $validated['no_telpon'],
        'Password' => Hash::make($validated['password']),
    ]);

    return redirect('/login/volunteer')
        ->with('success', 'Registrasi berhasil! Silakan login menggunakan akun kamu.');
});
