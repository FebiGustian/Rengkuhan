
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JurnalUmum extends Model
{
    protected $table = 'jurnal_umum';
    protected $primaryKey = 'ID_Jurnal_Umum';

    public $timestamps = false;

    protected $fillable = [
        'ID_Pembayaran',
        'ID_Akun',
        'Nominal',
    ];

    protected function casts(): array
    {
        return [
            'Nominal' => 'decimal:2',
        ];
    }

    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(
            Pembayaran::class,
            'ID_Pembayaran',
            'ID_Pembayaran'
        );
    }

    public function coa(): BelongsTo
    {
        return $this->belongsTo(
            Coa::class,
            'ID_Akun',
            'ID_Akun'
        );
    }
}
