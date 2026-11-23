<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'ID_Pembayaran';

    public $timestamps = false;

    protected $fillable = [
        'ID_Pendaftaran',
        'Nominal',
        'Metode_Pembayaran',
        'Status',
    ];

    protected function casts(): array
    {
        return [
            'Nominal' => 'decimal:2',
        ];
    }

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(
            Pendaftaran::class,
            'ID_Pendaftaran',
            'ID_Pendaftaran'
        );
    }

    public function jurnalUmum(): HasMany
    {
        return $this->hasMany(
            JurnalUmum::class,
            'ID_Pembayaran',
            'ID_Pembayaran'
        );
    }
}
