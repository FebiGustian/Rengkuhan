<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mandala_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('code_hash', 64)->unique();
            $table->unsignedInteger('created_by_mandala');
            $table->timestamp('expires_at')->index();
            $table->timestamp('used_at')->nullable()->index();
            $table->unsignedInteger('used_by_mandala')->nullable();
            $table->timestamps();

            $table->foreign('created_by_mandala')
                ->references('ID_Mandala')->on('mandala')
                ->cascadeOnDelete();

            $table->foreign('used_by_mandala')
                ->references('ID_Mandala')->on('mandala')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mandala_invitations');
    }
};
