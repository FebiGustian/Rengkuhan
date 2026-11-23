<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            if (!Schema::hasColumn('kegiatan', 'Kategori')) {
                $table->string('Kategori', 50)->default('Pendidikan')->after('Nama_Kegiatan');
            }
            if (!Schema::hasColumn('kegiatan', 'Lokasi')) {
                $table->string('Lokasi', 100)->default('Semarang')->after('Tanggal_Kegiatan');
            }
            if (!Schema::hasColumn('kegiatan', 'Waktu')) {
                $table->string('Waktu', 50)->default('09.00 - 12.00 WIB')->after('Lokasi');
            }
            if (!Schema::hasColumn('kegiatan', 'Penyelenggara')) {
                $table->string('Penyelenggara', 100)->default('Ranah Rengkuh')->after('Waktu');
            }
            if (!Schema::hasColumn('kegiatan', 'Biaya')) {
                $table->decimal('Biaya', 15, 2)->default(50000)->after('Kuota');
            }
            if (!Schema::hasColumn('kegiatan', 'Tujuan')) {
                $table->text('Tujuan')->nullable()->after('Deskripsi');
            }
            if (!Schema::hasColumn('kegiatan', 'Aktivitas')) {
                $table->text('Aktivitas')->nullable()->after('Tujuan');
            }
            if (!Schema::hasColumn('kegiatan', 'Persyaratan')) {
                $table->text('Persyaratan')->nullable()->after('Aktivitas');
            }
            if (!Schema::hasColumn('kegiatan', 'Perlengkapan')) {
                $table->text('Perlengkapan')->nullable()->after('Persyaratan');
            }
        });

        Schema::table('pendaftaran', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftaran', 'Alamat')) {
                $table->text('Alamat')->nullable()->after('Tanggal_Pendaftaran');
            }
            if (!Schema::hasColumn('pendaftaran', 'Motivasi')) {
                $table->text('Motivasi')->nullable()->after('Alamat');
            }
            if (!Schema::hasColumn('pendaftaran', 'Pengalaman')) {
                $table->text('Pengalaman')->nullable()->after('Motivasi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropColumn([
                'Kategori', 'Lokasi', 'Waktu', 'Penyelenggara', 'Biaya',
                'Tujuan', 'Aktivitas', 'Persyaratan', 'Perlengkapan'
            ]);
        });

        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn(['Alamat', 'Motivasi', 'Pengalaman']);
        });
    }
};
