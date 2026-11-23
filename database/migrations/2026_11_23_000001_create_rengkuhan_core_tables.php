<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('mandala')) {
            Schema::create('mandala', function (Blueprint $table) {
                $table->increments('ID_Mandala');
                $table->string('Nama', 100);
                $table->string('Email', 150)->unique();
                $table->string('Password', 255);
                $table->string('Jabatan', 100)->nullable();
                $table->string('No_Telpon', 20)->nullable();
            });
        }

        if (!Schema::hasTable('volunteer')) {
            Schema::create('volunteer', function (Blueprint $table) {
                $table->increments('ID_Volunteer');
                $table->string('Nama', 100);
                $table->string('Password', 255);
                $table->string('No_Telpon', 20)->nullable();
                $table->string('Email', 150)->unique();
            });
        }

        if (!Schema::hasTable('kegiatan')) {
            Schema::create('kegiatan', function (Blueprint $table) {
                $table->increments('ID_Kegiatan');
                $table->unsignedInteger('ID_Mandala');
                $table->string('Nama_Kegiatan', 150);
                $table->date('Tanggal_Kegiatan');
                $table->unsignedInteger('Kuota');
                $table->text('Deskripsi')->nullable();

                $table->foreign('ID_Mandala')->references('ID_Mandala')->on('mandala')->cascadeOnDelete();
            });
        }

        if (!Schema::hasTable('pendaftaran')) {
            Schema::create('pendaftaran', function (Blueprint $table) {
                $table->increments('ID_Pendaftaran');
                $table->unsignedInteger('ID_Volunteer');
                $table->unsignedInteger('ID_Kegiatan');
                $table->date('Tanggal_Pendaftaran');

                $table->foreign('ID_Volunteer')->references('ID_Volunteer')->on('volunteer')->cascadeOnDelete();
                $table->foreign('ID_Kegiatan')->references('ID_Kegiatan')->on('kegiatan')->cascadeOnDelete();
            });
        }

        if (!Schema::hasTable('pembayaran')) {
            Schema::create('pembayaran', function (Blueprint $table) {
                $table->increments('ID_Pembayaran');
                $table->unsignedInteger('ID_Pendaftaran');
                $table->decimal('Nominal', 15, 2)->default(0);
                $table->string('Metode_Pembayaran', 50)->nullable();
                $table->string('Status', 30)->default('Menunggu');

                $table->foreign('ID_Pendaftaran')->references('ID_Pendaftaran')->on('pendaftaran')->cascadeOnDelete();
            });
        }

        if (!Schema::hasTable('rab')) {
            Schema::create('rab', function (Blueprint $table) {
                $table->increments('ID_RAB');
                $table->unsignedInteger('ID_Kegiatan');
                $table->date('Tanggal');

                $table->foreign('ID_Kegiatan')->references('ID_Kegiatan')->on('kegiatan')->cascadeOnDelete();
            });
        }

        if (!Schema::hasTable('detail_rab')) {
            Schema::create('detail_rab', function (Blueprint $table) {
                $table->increments('ID_Detail_RAB');
                $table->unsignedInteger('ID_RAB');
                $table->string('Nama_Kebutuhan', 150);
                $table->decimal('Harga_Satuan', 15, 2);
                $table->unsignedInteger('Kuantitas');

                $table->foreign('ID_RAB')->references('ID_RAB')->on('rab')->cascadeOnDelete();
            });
        }

        if (!Schema::hasTable('coa')) {
            Schema::create('coa', function (Blueprint $table) {
                $table->increments('ID_Akun');
                $table->string('Nama_Akun', 100);
                $table->string('Jenis_Akun', 50);
                $table->string('Posisi', 20);
            });
        }

        if (!Schema::hasTable('jurnal_umum')) {
            Schema::create('jurnal_umum', function (Blueprint $table) {
                $table->increments('ID_Jurnal_Umum');
                $table->unsignedInteger('ID_Pembayaran');
                $table->unsignedInteger('ID_Akun');
                $table->decimal('Nominal', 15, 2);

                $table->foreign('ID_Pembayaran')->references('ID_Pembayaran')->on('pembayaran')->cascadeOnDelete();
                $table->foreign('ID_Akun')->references('ID_Akun')->on('coa')->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('jurnal_umum');
        Schema::dropIfExists('coa');
        Schema::dropIfExists('detail_rab');
        Schema::dropIfExists('rab');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('pendaftaran');
        Schema::dropIfExists('kegiatan');
        Schema::dropIfExists('volunteer');
        Schema::dropIfExists('mandala');
    }
};
