<?php

namespace App\Http\Controllers;

use PDF;
use App\Model\Aset;
use App\Model\Pemeliharaan;
use App\Model\Pengajuan;
use App\Model\Penyusutan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporan($method)
    {
        switch($method)
        {
            // Aset
            case 'aset':

                for($i=1; $i<=30; $i++)
                {
                    $tanggal = date('Y-m-'. $i);
                    $query = Aset::where('Tanggal_Masuk', $tanggal)->get();
                    $aset[] = count($query);
                }
                    
                $data = array(
                    'title' => 'Laporan Aset',
                    'data_aset' => $aset
                );

                return view('Laporan.aset', compact('data'));

            break;

            // Pemeliharaan
            case 'pemeliharaan':
                
                for($i=1; $i<=30; $i++)
                {
                    $tanggal = date('Y-m-'. $i);
                    $query = Pemeliharaan::where('Tanggal_Pemeliharaan', $tanggal)->get();
                    $pemeliharaan[] = count($query);
                }

                $data = array(
                    'title' => 'Laporan Pemeliharaan',
                    'data_pemeliharaan' => $pemeliharaan
                );

                return view('Laporan.pemeliharaan', compact('data'));

            break;

            // Pengajuan
            case 'pengajuan':

                for($i=1; $i<=30; $i++)
                {
                    $tanggal = date('Y-m-'. $i);
                    $query = Pengajuan::where('Tanggal_Pengajuan', $tanggal)->get();
                    $pengajuan[] = count($query);
                }

                $data = array(
                    'title' => 'Laporan Aset',
                    'data_pengajuan' => $pengajuan
                );
                
                return view('Laporan.pengajuan', compact('data'));

            break;
            
            // Penyusutan
            case 'penyusutan':

                for($i=1; $i<=30; $i++)
                {
                    $tanggal = date('Y-m-'. $i);
                    $query = Penyusutan::where('Tanggal_Penyusutan', $tanggal)->get();
                    $penyusutan[] = count($query);
                }

                $data = array(
                    'title' => 'Laporan Aset',
                    'data_penyusutan' => $penyusutan
                );

                return view('Laporan.penyusutan', compact('data'));

            break;
        }
    }

    public function downloadLaporan($method)
    {
        switch($method)
        {
            // Aset
            case 'aset':

                $data = array(
                    'title' => 'Laporan Aset',
                    'aset' => Aset::select('aset.*', 'ruangan.Nama_Ruangan')
                                ->leftJoin('ruangan', 'ruangan.ID_Ruangan', '=', 'aset.Ruangan_ID')->get()
                );

                $pdf = PDF::loadView('Laporan.aset_print', compact('data'))
                        ->setPaper('A4');
                $pdf->setPaper('letter', 'landscape');
                return $pdf->download('laporan-pengaduan-aset-' . date('Y-m-d_H-i-s'). '.pdf');

            break;
            
            // Pemeliharaan
            case 'pemeliharaan':

                $data = array(
                    'title' => 'Laporan Pemeliharaan',
                    'pemeliharaan' => Pemeliharaan::select('pemeliharaan.*', 'aset.Nama_Aset')
                                        ->leftJoin('aset', 'aset.Kode_Aset', '=', 'pemeliharaan.Aset_ID')->get()
                );

                $pdf = PDF::loadView('Laporan.pemeliharaan_print', compact('data'))
                        ->setPaper('A4');
                // $pdf->setPaper('letter', 'landscape');
                return $pdf->download('laporan-pemeliharaan-' . date('Y-m-d_H-i-s'). '.pdf');
                // return $data;

            break;

            // Pengajuan
            case 'pengajuan':

                $data = array(
                    'title' => 'Laporan Pengajuan',
                    'pengajuan' => Pengajuan::latest()->get()
                );

                $pdf = PDF::loadView('Laporan.pengajuan_print', compact('data'))
                        ->setPaper('A4');
                // $pdf->setPaper('letter', 'landscape');
                return $pdf->download('laporan-pengajuan-' . date('Y-m-d_H-i-s'). '.pdf');
                // return $data;

            break;

            // Penyusutan
            case 'penyusutan':

                $data = array(
                    'title' => 'Laporan Penyusutan',
                    'penyusutan' => Penyusutan::select('penyusutan.*', 'aset.Nama_Aset')
                                        ->leftJoin('aset', 'aset.Kode_Aset', '=', 'penyusutan.Aset_ID')->get()
                );

                $pdf = PDF::loadView('Laporan.penyusutan_print', compact('data'))
                        ->setPaper('A4');
                // $pdf->setPaper('letter', 'landscape');
                return $pdf->download('laporan-penyusutan-' . date('Y-m-d_H-i-s'). '.pdf');
                // return $data;

            break;
        }
    }
}
