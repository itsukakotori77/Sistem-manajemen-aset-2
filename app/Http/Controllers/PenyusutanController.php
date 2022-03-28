<?php

namespace App\Http\Controllers;

use Datatables;
use App\Model\Aset;
use App\Model\Penyusutan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenyusutanController extends Controller
{
    //
    public function index(Request $request)
    {
        $title = 'Penyusutan Aset';
        // $data = Penyusutan::latest()->get();
        $data = Penyusutan::select('penyusutan.*', 'aset.Nama_Aset', 'aset.Tanggal_Masuk')
                ->leftJoin('aset', 'aset.Kode_Aset', '=', 'penyusutan.Aset_ID')
                ->orderBy('penyusutan.created_at', 'DESC')->get();

        if($request->ajax())
        {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('Nama_Aset', function($data){
                        return $data->Nama_Aset;
                    })
                    ->editColumn('Tanggal_Penyusutan', function($data){
                        return date('d/m/Y', strtotime($data->Tanggal_Penyusutan));
                    })
                    ->editColumn('Tanggal_Masuk', function($data){
                        return date('d/m/Y', strtotime($data->Tanggal_Masuk));
                    })
                    ->editColumn('Status', function($data){
                        
                        if($data->Status === 1)
                            $status = '<div class="text-center"><span class="badge badge-pill badge-warning">Penyusutan</span></div>';
                        
                        return $status;
                    })
                    ->rawColumns(['Status'])
                    ->make(True);
        }

        return view('Penyusutan.index', compact('title'));
    }

    public function statusPenyusutan($id)
    {
        $aset = Aset::find($id);
        $aset->Status = 3;
        $aset->Save();

        // Create
        $penyusutan = Penyusutan::create([
            'Tanggal_Penyusutan' => Carbon::now()->format('Y-m-d'),
            'Aset_ID' => $id,
            'Status' => 1
        ]);


    }
}
