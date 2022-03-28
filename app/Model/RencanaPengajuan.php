<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RencanaPengajuan extends Model
{
    //
    protected $table = 'rencana_pengajuan';
    protected $primarykey = 'id';
    protected $fillable = [
        'Perencanaan_ID',
        'Pengajuan_ID'
    ];
}
