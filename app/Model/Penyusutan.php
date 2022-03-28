<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penyusutan extends Model
{
    //
    protected $table = 'penyusutan';
    protected $primaryKey = 'Kode_Penyusutan';
    protected $fillable = [
        'Tanggal_Penyusutan',
        'Aset_ID',
        'Status'
    ];
}
