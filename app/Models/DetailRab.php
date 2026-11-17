<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailRab extends Model
{
    protected $table = 'detail_rab';
    protected $primaryKey = 'ID_Detail_RAB';

    public $timestamps = false;

    protected $fillable = [
        'ID_RAB',
        'Nama_Kebutuhan',
        'Harga_Satuan',
        'Kuantitas',
    ];

    protected function casts(): array
    {
        return [
            'Harga_Satuan' => 'decimal:2',
            'Kuantitas' => 'integer',
            'Sub_Total' => 'decimal:2',
        ];
    }

    public function rab(): BelongsTo
    {
        return $this->belongsTo(
            Rab::class,
            'ID_RAB',
            'ID_RAB'
        );
    }
}
