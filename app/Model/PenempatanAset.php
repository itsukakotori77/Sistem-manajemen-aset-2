<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PenempatanAset extends Model
{
    // Atribut
    protected $table = 'penempatan_aset';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Ruangan_ID',
        'Aset_ID',
        'Jumlah',
        'Tanggal_Penempatan',
        'Status'
    ];

    // Method
}
