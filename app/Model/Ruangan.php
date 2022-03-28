<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    //
    protected $table = 'ruangan';
    protected $primaryKey = 'ID_Ruangan';
    protected $fillable = [
        'Nama_Ruangan',
    ];
}
