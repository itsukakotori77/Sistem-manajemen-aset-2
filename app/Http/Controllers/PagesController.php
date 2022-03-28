<?php

namespace App\Http\Controllers;

use App\Model\Aset;
use App\Model\Penyusutan;
use App\Model\Pemeliharaan;
use App\Model\Pengajuan;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function dashboard()
    {
        // Penyusutan
        for($i=1; $i<=30; $i++)
        {
            $tanggal = date('Y-m-'. $i);
            $query1 = Pemeliharaan::where('Tanggal_Pemeliharaan', $tanggal)->get();
            $pemeliharaan[] = count($query1);
        }

        // Pemeliharaan
        for($i=1; $i<=30; $i++)
        {
            $tanggal = date('Y-m-'. $i);
            $query2 = Penyusutan::where('Tanggal_Penyusutan', $tanggal)->get();
            $penyusutan[] = count($query2);
        }
        
        // Pengajuan diterima
        for($i=1; $i<=30; $i++)
        {
            $tanggal = date('Y-m-'. $i);
            $query3 = Pengajuan::where([
                ['Tanggal_Pengajuan', $tanggal],
                ['Status', 3],
            ])->get();
            $pengajuan_diterima[] = count($query3);
        }
        
        // Pengajuan diterima
        for($i=1; $i<=30; $i++)
        {
            $tanggal = date('Y-m-'. $i);
            $query4 = Pengajuan::where([
                ['Tanggal_Pengajuan', $tanggal],
                ['Status', 4],
            ])->get();
            $pengajuan_ditolak[] = count($query4);
        }

        $data = array(
            'penyusutan' => count(Penyusutan::all()),
            'data_penyusutan' => $penyusutan,
            'pemeliharaan' => count(Pemeliharaan::all()),
            'data_pemeliharaan' => $pemeliharaan,
            'pengajuan_diterima' => $pengajuan_diterima,
            'pengajuan_ditolak' => $pengajuan_ditolak,
        );

        return view('home.dashboard', compact('data'));
        // return $data;
    }
    
    public function test()
    {
        return view('layouts.app');
    }
}
