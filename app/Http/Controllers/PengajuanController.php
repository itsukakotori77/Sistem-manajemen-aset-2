<?php

namespace App\Http\Controllers;

use Auth;
use Datatables;
use PDF;
use Carbon\Carbon;
use App\Model\Pegawai;
use App\Model\Pengajuan;
use App\Model\Perencanaan;
use App\Model\RencanaPengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Query 
        $title = 'Pengajuan Aset';
        
        // $data = Pengajuan::select('pengajuan.*')
        //             ->orderBy('Tanggal_Pengajuan', 'DESC')
        //             ->get();

        if(Auth::user()->role_id === 2)
        {
            $data = Pengajuan::select('pengajuan.*')
                        ->orderBy('Tanggal_Pengajuan', 'DESC')
                        ->get();
        }
        elseif(Auth::user()->role_id === 3 || Auth::user()->role_id === 1)
        {
            $data = Pengajuan::select('pengajuan.*')
                        ->where('pengajuan.Status', '!=', 1)
                        ->orderBy('Tanggal_Pengajuan', 'DESC')
                        ->get();
        }

        if($request->ajax())
        {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('Status', function($data){
                        if($data->Status === 1)
                            $status = '<div class="text-center"><span class="badge badge-pill badge-secondary">Belum Diajukan</span></div>';
                        elseif($data->Status === 2)
                            $status = '<div class="text-center"><span class="badge badge-pill badge-info">Sedang Diajukan</span></div>';
                        elseif($data->Status === 3) 
                            $status = '<div class="text-center"><span class="badge badge-pill badge-success">Disetujui</span></div>';
                        elseif($data->Status === 4)
                            $status = '<div class="text-center"><span class="badge badge-pill badge-danger">Tidak Disetujui</span></div>';
                        else  
                            $status = '<div class="text-center"><span class="badge badge-pill badge-success">Selesai Ditambahkan</span></div>';
                        
                        return $status;
                    })
                    ->editColumn('Tanggal_Pengajuan', function($data){
                        return date('d-m-Y', strtotime($data->Tanggal_Pengajuan));
                    })
                    ->addColumn('Aksi', function($data){
                        if(Auth::user()->role_id === 3)
                        {
                            if($data->Status === 2)
                            {
                                $aksi = '
                                    <div class="text-center">
                                        <div class="dropdown d-inline mr-2">
                                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="' . url('/pengajuan/' . $data->Kode_Pengajuan) . '">Lihat Surat</a>
                                                <a class="dropdown-item" href="#" onclick="setujui(' . $data->Kode_Pengajuan . ')" >Setujui Pengajuan</a>
                                                <a class="dropdown-item" href="#" onclick="tolak(' . $data->Kode_Pengajuan . ')" >Tolak Pengajuan </a>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            } 
                            elseif($data->Status === 3 || $data->Status === 4){
                                $aksi = '
                                    <div class="text-center">
                                        <div class="dropdown d-inline mr-2">
                                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="' . url('/pengajuan/' . $data->Kode_Pengajuan) . '">Lihat Surat</a>
                                                <a class="dropdown-item" href="#" onclick="beliAset('. $data->Kode_Pengajuan .')" >Beli Aset</a>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }else{
                                $aksi = '
                                    <div class="text-center">
                                        <div class="dropdown d-inline mr-2">
                                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="' . url('/pengajuan/' . $data->Kode_Pengajuan) . '">Lihat Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        }else{
                            if($data->Status === 1)
                            {
                                $aksi = '
                                    <div class="text-center">
                                        <div class="dropdown d-inline mr-2">
                                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="' . url('/pengajuan/' . $data->Kode_Pengajuan) . '">Lihat Surat</a>
                                                <a class="dropdown-item" href="' . url('/pengajuan/' . $data->Kode_Pengajuan . '/edit') . '">Edit</a>
                                                <a class="dropdown-item" href="#" onclick="ajukan(' . $data->Kode_Pengajuan . ')">Ajukan Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                            else{
                                $aksi = '
                                    <div class="text-center">
                                        <div class="dropdown d-inline mr-2">
                                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="' . url('/pengajuan/' . $data->Kode_Pengajuan) . '">Lihat Surat</a>
                                                <a class="dropdown-item" href="#" onclick="ajukan(' . $data->Kode_Pengajuan . ')">Ajukan Surat</a>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        }

                        return $aksi;
                    })
                    ->rawColumns(['Status', 'Aksi'])
                    ->make(True);
        }

        return view('Pengajuan.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Perencanaan
        $perencanaan = Perencanaan::select('perencanaan.*')
                        ->leftJoin('rencana_pengajuan', 'rencana_pengajuan.Perencanaan_ID', '=', 'perencanaan.Kode_Perencanaan')
                        ->whereNull('rencana_pengajuan.Perencanaan_ID')
                        ->get();

        // Jurusan

        $data = array(
            'title' => 'Pengajuan Aset',
            'perencanaan' => $perencanaan,
        );

        return view('Pengajuan.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Pengajuan
        $pengajuan = Pengajuan::create([
            'Nama_Pengajuan' => $request->Nama_Pengajuan,
            'Tanggal_Pengajuan' => Carbon::createFromFormat('d-m-Y', $request->Tanggal_Pengajuan)->format('Y-m-d'),
            'Status' => 1,
        ]);

        // Perencanaan
        $perencanaan = $request->input('Perencanaan');
        foreach($perencanaan as $perencanaans)
        {
            RencanaPengajuan::create([
                'Pengajuan_ID' => $pengajuan->Kode_Pengajuan,
                'Perencanaan_ID' => $perencanaans
            ]);

            // Ubah Status
            $perencanaan_guru = Perencanaan::find($perencanaans);
            $perencanaan_guru->Status = 2;
            $perencanaan_guru->save();
        }

        // return True;
        return redirect('/pengajuan')->with('message', 'Pengajuan telah selesai dibuat');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Query
        $pengajuan = Pengajuan::find($id);
        $data = array(
            'pengajuan' => $pengajuan,
        );

        $pdf = PDF::loadView('Pengajuan.print', compact('data'))
                    ->setPaper('A4');
        return $pdf->stream('surat-pengajuan-aset-' . date('Y-m-d_H-i-s'). '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Query
        $pengajuan = Pengajuan::find($id);
        $perencanaan = Perencanaan::select('perencanaan.*')
                        ->leftJoin('rencana_pengajuan', 'rencana_pengajuan.Perencanaan_ID', '=', 'perencanaan.Kode_Perencanaan')
                        ->where('rencana_pengajuan.Pengajuan_ID', '=', $pengajuan->Kode_Pengajuan)
                        ->get();  

        // Jurusan
        $jurusan = Jurusan::all(); 

        $data = array(
            'title' => 'Pengajuan Aset',
            'perencanaan' => $perencanaan,
            'pengajuan' => $pengajuan,
            'jurusan' => $jurusan,
        );

        return view('Pengajuan.edit', compact('data'));
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
        $pengajuan = Pengajuan::find($id);
        $pengajuan->Nama_Pengajuan = $request->Nama_Pengajuan;
        $pengajuan->Jurusan_ID = $request->Jurusan;
        $pengajuan->Tanggal_Pengajuan = Carbon::createFromFormat('d-m-Y', $request->Tanggal_Pengajuan)->format('Y-m-d');
        $pengajuan->save();

        return redirect('/pengajuan')->with('message', 'Pengajuan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajukan_pengajuan($id)
    {
        $pengajuan = Pengajuan::find($id);
        $pengajuan->Status = 2;
        $pengajuan->save();

        // Loop
        foreach($pengajuan->perencanaan as $perencanaan)
        {
            $perencanaan = Perencanaan::find($perencanaan->Kode_Perencanaan);
            $perencanaan->Status = 3;
            $perencanaan->save();
        }

        // return redirect('/pengajuan')->with('message', 'Pengajuan berhasil diajukan');
    }

    public function persetujuan($id, $method)
    {
        switch($method)
        {
            case 'Setujui':
                $pengajuan = Pengajuan::find($id);
                $pengajuan->Status = 3;
                $pengajuan->save();

                // Perencanaan Diterima
                foreach($pengajuan->perencanaan as $perencanaan)
                {
                    $perencanaan = Perencanaan::find($perencanaan->Kode_Perencanaan);
                    $perencanaan->Status = 4;
                    $perencanaan->save();
                }
            break;
            
            case 'Tolak':
                $pengajuan = Pengajuan::find($id);
                $pengajuan->Status = 4;
                $pengajuan->save();

                // Perencanaan Ditolak
                foreach($pengajuan->perencanaan as $perencanaan)
                {
                    $perencanaan = Perencanaan::find($perencanaan->Kode_Perencanaan);
                    $perencanaan->Status = 5;
                    $perencanaan->save();
                }
            break;

            default:
                return 'none';
            break;
        }
    }
}
