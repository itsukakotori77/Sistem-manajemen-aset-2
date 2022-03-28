<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    //
    protected $table = 'pembelian';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Pengajuan_ID',
        'Tanggal_Pembelian',
        'Status',
    ];
}
