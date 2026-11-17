<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Volunteer extends Model
{
    protected $table = 'volunteer';

    protected $primaryKey = 'ID_Volunteer';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'Nama',
        'Password',
        'No_Telpon',
        'Email',
    ];

    protected $hidden = [
        'Password',
    ];

    public function pendaftaran(): HasMany
    {
        return $this->hasMany(
            Pendaftaran::class,
            'ID_Volunteer',
            'ID_Volunteer'
        );
    }
}
