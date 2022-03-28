<?php

namespace App\Http\Controllers;

use Datatables;
use App\Model\Aset;
use App\Model\Pemeliharaan;
use App\Model\Penyusutan;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    //

    public function index(Request $request)
    {
        $title = 'Monitoring Aset';

        $data = Aset::select('aset.Nama_Aset', 'aset.Kode_Aset', 'aset.Kondisi_Aset', 'ruangan.Nama_Ruangan')
                    ->leftJoin('ruangan', 'ruangan.ID_Ruangan', '=', 'aset.Ruangan_ID')
                    ->get();

        if($request->ajax())
        {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('Kondisi_Aset', function($data){
                        if($data->Kondisi_Aset === 1)
                            $kondisi = 'Baru';
                        else
                            $kondisi = 'Bekas';

                        return $kondisi;
                    })
                    ->addColumn('Aksi', function($data){
                        return 
                            '
                                <div class="text-center">
                                    <div class="dropdown d-inline mr-2">
                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="' . url('/monitoring/' . $data->Kode_Aset) . '">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            ';
                    })
                    ->rawColumns(['Aksi'])
                    ->make(True);
        }

        return view('Monitoring.index', compact('title'));
    }

    public function show($id)
    {
        $data = array(
            'title' => 'Detail Monitoring',
            'aset' => Aset::select(
                            'aset.*', 
                            'pemeliharaan.Pemeliharaan',
                            'pemeliharaan.Faktor',
                            'pemeliharaan.Kerusakan',
                            'ruangan.Nama_Ruangan'
                        )
                        ->leftJoin('pemeliharaan', 'pemeliharaan.Aset_ID', '=', 'aset.Kode_Aset')
                        ->leftJoin('ruangan', 'ruangan.ID_Ruangan', '=', 'aset.Ruangan_ID')
                        ->first(),
        );

        return view('Monitoring.show', compact('data'));
        // return $data;
    }
}
