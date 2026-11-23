<?php

namespace Database\Seeders;

use App\Models\Coa;
use App\Models\Kegiatan;
use App\Models\Mandala;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Rab;
use App\Models\DetailRab;
use App\Models\Volunteer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Akun COA Keuangan
        $coaData = [
            ['Nama_Akun' => 'Kas Operasional', 'Jenis_Akun' => 'Aset Lancar', 'Posisi' => 'Debit'],
            ['Nama_Akun' => 'Bank BCA Rengkuhan', 'Jenis_Akun' => 'Aset Lancar', 'Posisi' => 'Debit'],
            ['Nama_Akun' => 'Pendapatan Kontribusi Volunteer', 'Jenis_Akun' => 'Pendapatan', 'Posisi' => 'Kredit'],
            ['Nama_Akun' => 'Pendapatan Donasi', 'Jenis_Akun' => 'Pendapatan', 'Posisi' => 'Kredit'],
            ['Nama_Akun' => 'Beban Logistik & Konsumsi', 'Jenis_Akun' => 'Beban', 'Posisi' => 'Debit'],
            ['Nama_Akun' => 'Beban Transportasi & Akomodasi', 'Jenis_Akun' => 'Beban', 'Posisi' => 'Debit'],
        ];

        foreach ($coaData as $coa) {
            Coa::firstOrCreate(['Nama_Akun' => $coa['Nama_Akun']], $coa);
        }

        // 2. Seed Pengurus (Mandala) & Admin
        $admin = Mandala::firstOrCreate(
            ['Email' => 'admin@rengkuhan.org'],
            [
                'Nama' => 'Admin Ranah Rengkuh',
                'Password' => Hash::make('admin12345'),
                'Jabatan' => 'Administrator',
                'No_Telpon' => '081234567890',
            ]
        );

        $pengurus = Mandala::firstOrCreate(
            ['Email' => 'pengurus@rengkuhan.org'],
            [
                'Nama' => 'Siti Rahmawati (Koordinator Program)',
                'Password' => Hash::make('pengurus12345'),
                'Jabatan' => 'Pengurus',
                'No_Telpon' => '082198765432',
            ]
        );

        // 3. Seed Volunteer Contoh
        $volunteer1 = Volunteer::firstOrCreate(
            ['Email' => 'volunteer@rengkuhan.org'],
            [
                'Nama' => 'Firza Volunteer',
                'Password' => Hash::make('volunteer12345'),
                'No_Telpon' => '085712345678',
            ]
        );

        $volunteer2 = Volunteer::firstOrCreate(
            ['Email' => 'anisa@gmail.com'],
            [
                'Nama' => 'Anisa Dian',
                'Password' => Hash::make('volunteer12345'),
                'No_Telpon' => '081399887766',
            ]
        );

        // 4. Seed Kegiatan
        $kegiatan1 = Kegiatan::firstOrCreate(
            ['Nama_Kegiatan' => 'Rengkuh Desa: Mengajar & Berbagi Inspirasi'],
            [
                'ID_Mandala' => $pengurus->ID_Mandala,
                'Tanggal_Kegiatan' => now()->addDays(14)->format('Y-m-d'),
                'Kuota' => 25,
                'Deskripsi' => 'Program pengabdian masyarakat di Desa Sukamaju, mencakup sesi mengajar kreatif anak usia SD, workshop literasi digital sederhana, dan pembagian perlengkapan belajar.',
            ]
        );

        $kegiatan2 = Kegiatan::firstOrCreate(
            ['Nama_Kegiatan' => 'Peduli Alam: Tanam 500 Mangrove Pesisir'],
            [
                'ID_Mandala' => $pengurus->ID_Mandala,
                'Tanggal_Kegiatan' => now()->addDays(28)->format('Y-m-d'),
                'Kuota' => 40,
                'Deskripsi' => 'Aksi nyata pelestarian lingkungan pesisir pantai utara dengan penanaman 500 bibit mangrove bersama komunitas pegiat lingkungan dan pemuda setempat.',
            ]
        );

        $kegiatan3 = Kegiatan::firstOrCreate(
            ['Nama_Kegiatan' => 'Dapur Sehat Rengkuhan: Nutrisi untuk Lansia'],
            [
                'ID_Mandala' => $admin->ID_Mandala,
                'Tanggal_Kegiatan' => now()->addDays(40)->format('Y-m-d'),
                'Kuota' => 20,
                'Deskripsi' => 'Pendistribusian makanan bergizi dan pemeriksaan kesehatan dasar gratis bagi lansia di perkampungan pinggiran kota.',
            ]
        );

        // 5. Seed RAB untuk Kegiatan 1
        $rab1 = Rab::firstOrCreate(
            ['ID_Kegiatan' => $kegiatan1->ID_Kegiatan],
            ['Tanggal' => now()->format('Y-m-d')]
        );

        DetailRab::firstOrCreate(
            ['ID_RAB' => $rab1->ID_RAB, 'Nama_Kebutuhan' => 'Paket Modul Belajar Siswa'],
            ['Harga_Satuan' => 25000, 'Kuantitas' => 50]
        );
        DetailRab::firstOrCreate(
            ['ID_RAB' => $rab1->ID_RAB, 'Nama_Kebutuhan' => 'Konsumsi & Snack Panitia/Volunteer'],
            ['Harga_Satuan' => 20000, 'Kuantitas' => 35]
        );
        DetailRab::firstOrCreate(
            ['ID_RAB' => $rab1->ID_RAB, 'Nama_Kebutuhan' => 'Sewa Kendaraan Operasional'],
            ['Harga_Satuan' => 350000, 'Kuantitas' => 2]
        );

        // 6. Seed Pendaftaran & Pembayaran Contoh
        $pendaftaran1 = Pendaftaran::firstOrCreate(
            [
                'ID_Volunteer' => $volunteer1->ID_Volunteer,
                'ID_Kegiatan' => $kegiatan1->ID_Kegiatan,
            ],
            [
                'Tanggal_Pendaftaran' => now()->subDays(2)->format('Y-m-d'),
            ]
        );

        Pembayaran::firstOrCreate(
            ['ID_Pendaftaran' => $pendaftaran1->ID_Pendaftaran],
            [
                'Nominal' => 50000,
                'Metode_Pembayaran' => 'QRIS',
                'Status' => 'Lunas',
            ]
        );

        $pendaftaran2 = Pendaftaran::firstOrCreate(
            [
                'ID_Volunteer' => $volunteer2->ID_Volunteer,
                'ID_Kegiatan' => $kegiatan1->ID_Kegiatan,
            ],
            [
                'Tanggal_Pendaftaran' => now()->subDay()->format('Y-m-d'),
            ]
        );

        Pembayaran::firstOrCreate(
            ['ID_Pendaftaran' => $pendaftaran2->ID_Pendaftaran],
            [
                'Nominal' => 50000,
                'Metode_Pembayaran' => 'Transfer Bank BCA',
                'Status' => 'Menunggu Verifikasi',
            ]
        );
    }
}
