<?php

namespace App\Http\Controllers;

use Datatables;
use Carbon\Carbon;
use App\Model\Aset;
use App\Model\Pembelian;
use App\Model\Pengajuan;
use App\Model\Perencanaan;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;

class PembelianController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Pembelian Aset';

        $data = Pembelian::select(
                    'pembelian.*', 
                    'pengajuan.Nama_Pengajuan', 
                    'pengajuan.Tanggal_Pengajuan', 
                    'pengajuan.Kode_Pengajuan', 
                    'perencanaan.Nama_Aset', 
                    'perencanaan.Jumlah_Aset', 
                    'perencanaan.Total_Harga'
                )
                ->leftJoin('pengajuan', 'pengajuan.Kode_Pengajuan', '=', 'pembelian.Pengajuan_ID')
                ->leftJoin('rencana_pengajuan', 'rencana_pengajuan.Pengajuan_ID', '=', 'pengajuan.Kode_Pengajuan')
                ->leftJoin('perencanaan', 'perencanaan.Kode_Perencanaan', '=', 'rencana_pengajuan.Perencanaan_ID')
                ->orderBy('pembelian.Tanggal_Pembelian', 'DESC')
                ->get();

        if($request->ajax())
        {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('Nama_Aset', function($data){
                        return $data->Nama_Aset;
                    })
                    ->editColumn('Nama_Pengajuan', function($data){
                        return $data->Nama_Pengajuan;
                    })
                    ->editColumn('Tanggal_Pengajuan', function($data){
                        return date('d/m/Y', strtotime($data->Tanggal_Pengajuan));
                    })
                    ->editColumn('Tanggal_Pembelian', function($data){
                        return date('d/m/Y', strtotime($data->Tanggal_Pembelian));
                    })
                    ->editColumn('Status', function($data){
                        if($data->Status === 1)
                            $status = '<div class="text-center"><span class="badge badge-pill badge-primary">Dibeli</span></div>';
                        elseif($data->Status === 2)
                            $status = '<div class="text-center"><span class="badge badge-pill badge-primary">Telah Ditambahkan</span></div>';
                        else 
                            $status = '<div class="text-center"><span class="badge badge-pill badge-secondary">Belum Ada Penanganan</span></div>';
                            
                        return $status;
                    })
                    ->addColumn('Aksi', function($data){

                        if($data->Status === 1)
                        {
                            $aksi = 
                            '
                                <div class="text-center">
                                    <div class="dropdown d-inline mr-2">
                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" onclick="tambahAset(' . $data->Kode_Pengajuan . ')" href="#">Tambah Aset</a>
                                        </div>
                                    </div>
                                </div>
                            ';

                        }else{
                            $aksi = 'Tidak ada aksi';
                        }

                        return $aksi;
                    })
                    ->rawColumns(['Status', 'Aksi'])
                    ->make(True);
        }

        return view('Pembelian.index', compact('title'));
        // return $data;
    }
    
    public function store(Request $request, $id)
    {
        // $pengajuan::find($id);

        $pembelian = Pembelian::where('Pengajuan_ID', '=', $id)->first();

        if($pembelian)
        {
            
        }else{
            Pembelian::create([
                'Pengajuan_ID' => $id,
                'Tanggal_Pembelian' => Carbon::now()->format('Y-m-d'),
                'Status' => 1,
            ]);
        }

        $pengajuan = Pengajuan::find($id);
        $pengajuan->Status = 5;
        $pengajuan->save();
    }

    public function createIndikator()
    {
        $data = array(
            'title' => 'Form Indikator',
            'aset' => Aset::select('aset.Nama_Aset', 'aset.Kode_Aset', 'ruangan.Nama_Ruangan')
                        ->leftJoin('ruangan', 'ruangan.ID_Ruangan', '=', 'aset.Ruangan_ID')
                        ->orderBy('aset.created_at', 'DESC')
                        ->where('aset.Status', '=', 4)
                        ->get()
        );

        return view('Aset.indikator', compact('data'));
        // return $data;
    }

    public function showAset($id)
    {
        return Aset::find($id);
    }

    public function updateIndikator(Request $request)
    {
        $aset = Aset::find($request->Aset_ID);
        $aset->Kode = $request->Kode_Aset;
        $aset->Umur_Ergonomis = $request->Umur_Ergonomis;
        $aset->Keterangan = $request->Keterangan;
        $aset->Sumber_Aset = $request->Sumber_Aset;
        $aset->Status = 1;

        // Upload Gambar
        if($request->file('Foto_Avatar') != '') 
        {
            //Change Path of Picture
            $file = $request->file('Foto_Avatar');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak; 

            // Croping Picture
            $image_resize = Image::make($file->getRealPath());              
            $image_resize->resize(200, 200);
            $image_resize->save(public_path('data/Foto-Aset/' . $fileName));
            $avatar = $fileName;
            $aset->Foto = $avatar;
        }

        $aset->save();

        return redirect('/pembelian')->with('message', 'Data indikator aset berhasil ditambahkan');
    }

    public function tambahAset($id)
    {
        $pengajuan = Pengajuan::find($id);

        foreach($pengajuan->perencanaan as $perencanaan)
        {
            Aset::create([
                'Kode' => '',
                'Nama_Aset' => $perencanaan->Nama_Aset,
                'Merek_Aset' => $perencanaan->Merek_Aset,
                'Jumlah_Aset' => $perencanaan->Jumlah_Aset,
                'Harga_Aset' => $perencanaan->Satuan_Harga,
                'Total_Harga' => $perencanaan->Total_Harga,
                'Kondisi_Aset' => 1,
                'Tanggal_Masuk' => Carbon::now()->format('Y-m-d'),
                'Keterangan',
                'Ruangan_ID' => $perencanaan->Ruangan_ID,
                'Foto',
                'Status' => 4,
            ]);
        }

        // Pembelian
        $pembelian = Pembelian::where('Pengajuan_ID', '=', $id)->first();
        $pembelian->Status = 2;
        $pembelian->save();
    }
}
