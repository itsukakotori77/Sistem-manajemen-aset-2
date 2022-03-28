<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $table = 'aset';
    protected $primaryKey = 'Kode_Aset';
    protected $fillable = [
        'Kode',
        'Nama_Aset',
        'Nama_Pengaju',
        'Jenis_Aset',
        'Merek_Aset',
        'Jumlah_Aset',
        'Harga_Aset',
        'Total_Harga',
        'Kondisi_Aset',
        'Tanggal_Masuk',
        'Umur_Ergonomis',
        'Keterangan',
        'Sumber_Aset',
        'Ruangan_ID',
        'Status',
        'Foto',
    ];

    // Method
    public function ruangan()
    {
        return $this->belongsToMany(Ruangan::class, 'penempatan_aset', 'Ruangan_ID', 'Aset_ID');
    }

    public function stock()
    {
        return $this->hasOne(StockAset::class, 'Aset_ID');
    }

    public function pengajuan()
    {
        return $this->belongsToMany(Pengajuan::class, 'aset_pengajuan', 'Aset_ID', 'Pengajuan_ID');
    }
}
