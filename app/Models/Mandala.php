<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mandala extends Model
{
    protected $table = 'mandala';

    protected $primaryKey = 'ID_Mandala';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Nama',
        'Email',
        'Password',
        'Jabatan',
        'No_Telpon',
    ];

    protected $hidden = [
        'Password',
    ];

    public function kegiatan(): HasMany
    {
        return $this->hasMany(
            Kegiatan::class,
            'ID_Mandala',
            'ID_Mandala'
        );
    }
}
