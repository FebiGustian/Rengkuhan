<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $primaryKey = 'ID_Kegiatan';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'ID_Mandala',
        'Nama_Kegiatan',
        'Tanggal_Kegiatan',
        'Kuota',
        'Deskripsi',
    ];

    protected function casts(): array
    {
        return [
            'Tanggal_Kegiatan' => 'date',
            'Kuota' => 'integer',
        ];
    }

    // Relasi ke Mandala
    public function mandala(): BelongsTo
    {
        return $this->belongsTo(
            Mandala::class,
            'ID_Mandala',
            'ID_Mandala'
        );
    }

    // Relasi ke Pendaftaran
    public function pendaftaran(): HasMany
    {
        return $this->hasMany(
            Pendaftaran::class,
            'ID_Kegiatan',
            'ID_Kegiatan'
        );
    }

    // Relasi ke RAB
    public function rab(): HasOne
    {
        return $this->hasOne(
            Rab::class,
            'ID_Kegiatan',
            'ID_Kegiatan'
        );
    }
}
