<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'ID_Pendaftaran';

    public $timestamps = false;

    protected $fillable = [
        'ID_Volunteer',
        'ID_Kegiatan',
        'Tanggal_Pendaftaran',
        'Alamat',
        'Motivasi',
        'Pengalaman',
    ];

    protected function casts(): array
    {
        return [
            'Tanggal_Pendaftaran' => 'date',
        ];
    }

    public function volunteer(): BelongsTo
    {
        return $this->belongsTo(
            Volunteer::class,
            'ID_Volunteer',
            'ID_Volunteer'
        );
    }

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(
            Kegiatan::class,
            'ID_Kegiatan',
            'ID_Kegiatan'
        );
    }

    public function pembayaran(): HasMany
    {
        return $this->hasMany(
            Pembayaran::class,
            'ID_Pendaftaran',
            'ID_Pendaftaran'
        );
    }
}
