
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rab extends Model
{
    protected $table = 'rab';
    protected $primaryKey = 'ID_RAB';

    public $timestamps = false;

    protected $fillable = [
        'ID_Kegiatan',
        'Tanggal',
    ];

    protected function casts(): array
    {
        return [
            'Tanggal' => 'date',
        ];
    }

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(
            Kegiatan::class,
            'ID_Kegiatan',
            'ID_Kegiatan'
        );
    }

    public function detailRab(): HasMany
    {
        return $this->hasMany(
            DetailRab::class,
            'ID_RAB',
            'ID_RAB'
        );
    }
}
