<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    //
    protected $table = 'pemeliharaan';
    protected $primaryKey = 'Kode_Pemeliharaan';
    protected $fillable = [
        'Kerusakan',
        'Faktor',
        'Pemeliharaan',
        'Jumlah',
        'Foto',
        'Status',
        'Aset_ID',
    ];
}
