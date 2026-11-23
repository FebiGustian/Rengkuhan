<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('kegiatan') && !Schema::hasColumn('kegiatan', 'Foto_Kegiatan')) {
            Schema::table('kegiatan', function (Blueprint $table) {
                $table->string('Foto_Kegiatan', 255)->nullable()->after('Deskripsi');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('kegiatan') && Schema::hasColumn('kegiatan', 'Foto_Kegiatan')) {
            Schema::table('kegiatan', function (Blueprint $table) {
                $table->dropColumn('Foto_Kegiatan');
            });
        }
    }
};
