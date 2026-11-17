<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coa extends Model
{
    protected $table = 'coa';
    protected $primaryKey = 'ID_Akun';

    public $timestamps = false;

    protected $fillable = [
        'Nama_Akun',
        'Jenis_Akun',
        'Posisi',
    ];

    public function jurnalUmum(): HasMany
    {
        return $this->hasMany(
            JurnalUmum::class,
            'ID_Akun',
            'ID_Akun'
        );
    }
}
