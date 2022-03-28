<?php

namespace App\Http\Controllers;

use Auth;
use Datatables;
use Carbon\Carbon;
use App\Model\Perencanaan;
use App\Model\Pegawai;
use App\Model\Ruangan;
use Illuminate\Http\Request;

class PerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Perencanaan';

        // Query
        $data = Perencanaan::select('perencanaan.*', 'ruangan.Nama_Ruangan')
                ->leftJoin('ruangan', 'ruangan.ID_Ruangan', '=', 'perencanaan.Ruangan_ID')
                ->orderBy('perencanaan.created_at', 'DESC')
                ->get();
        
        // $data = Perencanaan::latest();

        if($request->ajax())
        {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('Tanggal_Perencanaan', function($data){
                        return date('d-m-Y', strtotime($data->Tanggal_Perencanaan));
                    })
                    ->editColumn('Jenis_Aset', function($data){
                        if($data->Jenis_Aset === 1)
                            $jenis = 'Aset Tetap';
                        else 
                            $jenis = 'Aset Habis Pakai';
                            
                        return $jenis;
                    })
                    ->editColumn('Status', function($data){
                        if($data->Status === 1)
                            $status = '<div class="text-center"><span class="badge badge-pill badge-secondary">Belum Diajukan</span></div>';
                        elseif($data->Status === 2)
                            $status = '<div class="text-center"><span class="badge badge-pill badge-primary">Menunggu Persetujuan</span></div>';
                        elseif($data->Status === 3)
                            $status = '<div class="text-center"><span class="badge badge-pill badge-warning">Telah Diajukan</span></div>';
                        elseif($data->Status === 4)
                            $status = '<div class="text-center"><span class="badge badge-pill badge-success">Perencanaan Diterima</span></div>';
                        else 
                            $status = '<div class="text-center"><span class="badge badge-pill badge-danger">Perencanaan Ditolak</span></div>';

                        return $status;
                    })
                    ->addColumn('Ruangan', function($data){
                        return $data->Nama_Ruangan;
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
                                            <a class="dropdown-item" onclick="show(' . $data->Kode_Perencanaan . ')" href="#">View</a>
                                            <a class="dropdown-item" href="' . url('/perencanaan/' . $data->Kode_Perencanaan . '/edit') . '">Edit</a>
                                            <a class="dropdown-item" onclick="deleteData(' . $data->Kode_Perencanaan . ')" href="#">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            ';
                    })
                    ->rawColumns(['Aksi', 'Status'])
                    ->make(True);
        }

        return view('Perencanaan.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $title = 'Perencanaan';
        $data = array(
            'title' => 'Tambah Perencanaan',
            'ruangan' => Ruangan::all()
        );

        return view('Perencanaan.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nama_Perencanaan' => 'required',
            'Nama_Aset' => 'required',
            'Merek_Aset' => 'required',
            'Kuantitas' => 'required',
            'Satuan_Harga' => 'required',
            'Total_Harga' => 'required',
            'Alasan' => 'required',
        ]);

        // Store
        $perencanaan = Perencanaan::create([
            'Nama_Perencanaan' => $request->Nama_Perencanaan,
            'Nama_Pengaju' => $request->Nama_Pengaju,
            'Nama_Aset' => $request->Nama_Aset,
            'Merek_Aset' => $request->Merek_Aset,
            'Jumlah_Aset' => $request->Kuantitas,
            'Satuan_Harga' => $request->Satuan_Harga,
            'Total_Harga' => $request->Total_Harga,
            'Alasan' => $request->Alasan,
            'Tanggal_Perencanaan' => Carbon::now()->format('Y-m-d'),
            'Status' => 1,
            'Ruangan_ID' => $request->Ruangan,
        ]);

        return redirect('/perencanaan')->with('message', 'Perencanaan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $data = Perencanaan::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array(
            'title' => 'Perencanaan',
            'perencanaan' => Perencanaan::find($id),
            'ruangan' => Ruangan::all()
        );

        return view('Perencanaan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama_Perencanaan' => 'required',
            'Nama_Aset' => 'required',
            'Jenis_Aset' => 'required',
            'Merek_Aset' => 'required',
            'Kuantitas' => 'required',
            'Satuan_Harga' => 'required',
            'Total_Harga' => 'required',
            'Alasan' => 'required',
        ]);

        // Update
        $perencanaan = Perencanaan::find($id);
        $perencanaan->Nama_Perencanaan = $request->Nama_Perencanaan;
        $perencanaan->Nama_Pengaju = $request->Nama_Pengaju;
        $perencanaan->Nama_Aset = $request->Nama_Aset;
        $perencanaan->Jenis_Aset = $request->Jenis_Aset;
        $perencanaan->Merek_Aset = $request->Merek_Aset;
        $perencanaan->Satuan_Harga = $request->Satuan_Harga;
        $perencanaan->Total_Harga = $request->Total_Harga;
        $perencanaan->Alasan = $request->Alasan;
        $perencanaan->save();

        // Return
        return redirect('/perencanaan')->with('message', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perencanaan = Perencanaan::findOrFail($id);
        $perencanaan->delete();

        return redirect('/perencanaan')->with('message', 'Perencanaan berhasil dihapus');
    }

    public function ubahStatus($id)
    {
        $perencanaan = Perencanaan::find($id);
    }
}
