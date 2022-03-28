<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $table = 'pegawai';
    protected $primaryKey = 'ID_Pegawai';
    protected $fillable = [
        'NIP',
        'Nama_Depan',
        'Nama_Belakang',
        'Jenis_Kelamin',
        'Alamat',
        'Tempat_Lahir',
        'Tanggal_Lahir',
        'Foto',
        'User_ID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
