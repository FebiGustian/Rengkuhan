<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Ranah Rengkuh (Rengkuhan)
|--------------------------------------------------------------------------
*/

// Halaman Beranda & Pilihan Role
Route::get('/', [AuthController::class, 'showRoleSelection'])->name('home');
Route::post('/pilih-role', [AuthController::class, 'selectRole'])->name('pilih-role');

// Autentikasi (Login & Register)
Route::get('/login/{role}', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login/{role}', [AuthController::class, 'login']);
Route::get('/register/volunteer', [AuthController::class, 'showRegisterVolunteer'])->name('register.volunteer');
Route::post('/register/volunteer', [AuthController::class, 'registerVolunteer']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Area Volunteer (Dilindungi Middleware)
Route::middleware(['role:volunteer'])->prefix('dashboard/volunteer')->name('volunteer.')->group(function () {
    Route::get('/', [VolunteerController::class, 'dashboard'])->name('dashboard');
    Route::get('/kegiatan', [VolunteerController::class, 'dashboard'])->name('kegiatan');
    Route::get('/kegiatan/{idKegiatan}', [VolunteerController::class, 'detailKegiatan'])->name('kegiatan.detail');
    Route::get('/kegiatan/{idKegiatan}/daftar', [VolunteerController::class, 'formDaftarKegiatan'])->name('kegiatan.daftar.form');
    Route::post('/kegiatan/{idKegiatan}/daftar', [VolunteerController::class, 'submitDaftarKegiatan'])->name('kegiatan.daftar.submit');

    // Pembayaran & Riwayat
    Route::get('/pembayaran', [VolunteerController::class, 'halamanPembayaran'])->name('pembayaran');
    Route::get('/pembayaran/{idPembayaran}/instruksi', [VolunteerController::class, 'instruksiPembayaran'])->name('pembayaran.instruksi');
    Route::post('/pembayaran/{idPembayaran}/konfirmasi', [VolunteerController::class, 'konfirmasiPembayaran'])->name('pembayaran.konfirmasi');
    Route::get('/riwayat', [VolunteerController::class, 'halamanRiwayat'])->name('riwayat');

    // Profil
    Route::post('/profil/update', [VolunteerController::class, 'updateProfil'])->name('profil.update');
});

// Area Pengurus (Mandala)
Route::middleware(['role:pengurus'])->prefix('dashboard/pengurus')->name('pengurus.')->group(function () {
    Route::get('/', [PengurusController::class, 'dashboard'])->name('dashboard');

    // Kelola Kegiatan
    Route::get('/kegiatan', [PengurusController::class, 'kelolaKegiatan'])->name('kegiatan.index');
    Route::get('/kegiatan/tambah', [PengurusController::class, 'formTambahKegiatan'])->name('kegiatan.tambah');
    Route::post('/kegiatan', [PengurusController::class, 'storeKegiatan'])->name('kegiatan.store');
    Route::delete('/kegiatan/{id}', [PengurusController::class, 'destroyKegiatan'])->name('kegiatan.destroy');

    // Kelola Volunteer & Laporan Pendaftar
    Route::get('/volunteer', [PengurusController::class, 'kelolaVolunteer'])->name('volunteer.index');
    Route::get('/laporan-pendaftar', [PengurusController::class, 'laporanPendaftar'])->name('laporan.pendaftar');
    Route::get('/pendaftar/{idPendaftaran}', [PengurusController::class, 'detailPendaftar'])->name('detail.pendaftar');

    // Rekap Pembayaran & Verifikasi
    Route::get('/rekap-pembayaran', [PengurusController::class, 'rekapPembayaran'])->name('rekap.pembayaran');
    Route::post('/pembayaran/{idPembayaran}/verifikasi', [PengurusController::class, 'verifikasiPembayaran'])->name('pembayaran.verifikasi');

    // Generate RAB dengan AI
    Route::get('/generate-rab-ai', [PengurusController::class, 'generateRabAi'])->name('generate.rab.ai');
    Route::post('/generate-rab-ai', [PengurusController::class, 'generateRabAi'])->name('generate.rab.ai.post');
    Route::post('/kegiatan/{idKegiatan}/simpan-rab-ai', [PengurusController::class, 'simpanRekomendasiRab'])->name('simpan.rekomendasi.rab');
});

// Alias route lama bila ada yang mengakses /dashboard/mandala
Route::get('/dashboard/mandala', function () {
    return redirect()->route('pengurus.dashboard');
});

// Area Admin
Route::middleware(['role:admin'])->prefix('dashboard/admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/mandala', [AdminController::class, 'storeMandala'])->name('mandala.store');
    Route::delete('/mandala/{id}', [AdminController::class, 'destroyMandala'])->name('mandala.destroy');
    Route::delete('/volunteer/{id}', [AdminController::class, 'destroyVolunteer'])->name('volunteer.destroy');
    Route::post('/coa', [AdminController::class, 'storeCoa'])->name('coa.store');
});
