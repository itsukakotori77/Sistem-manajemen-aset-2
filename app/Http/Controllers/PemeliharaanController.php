<?php

namespace App\Http\Controllers;

use Datatables;
use App\Model\Aset;
use App\Model\Pemeliharaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class PemeliharaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Pemeliharaan';
        // $data = Pemeliharaan::latest()->get();
        $data = Pemeliharaan::select('pemeliharaan.*', 'aset.Nama_Aset', 'aset.Kode_Aset')
                ->leftJoin('aset', 'aset.Kode_Aset', '=', 'pemeliharaan.Aset_ID')
                ->orderBy('pemeliharaan.Tanggal_Pemeliharaan', 'DESC')
                ->get();

        if($request->ajax())
        {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('Tanggal_Pemeliharaan', function($data){
                        return date('d-m-Y', strtotime($data->Tanggal_Pemeliharaan));
                    })
                    ->addColumn('Status', function($data){
                        
                        if($data->Status === 1)
                            $status = '<span class="badge badge-pill badge-primary">Sedang diperbaiki</span>';
                        else
                            $status = '<span class="badge badge-pill badge-success">Selesai diperbaiki</span>';
                        
                        return $status;
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
                                            <a class="dropdown-item" onclick="show(' . $data->Kode_Pemeliharaan . ')" href="#">View</a>
                                            <a class="dropdown-item" href="' . url('/pemeliharaan/' . $data->Kode_Pemeliharaan . '/edit') . '">Edit</a>
                                            <a class="dropdown-item" onclick="hapus('. $data->Kode_Pemeliharaan .')" href="#">Hapus</a>
                                            <a class="dropdown-item" onclick="penyusutan('. $data->Kode_Aset .')" href="#">Penyusutan</a>
                                        </div>
                                    </div>
                                </div>
                            ';
                    })
                    ->rawColumns(['Status', 'Aksi'])
                    ->make(True);
        }

        return view('Pemeliharaan.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'title' => 'Pemeliharaan Aset',
            'aset' => Aset::select('aset.Kode_Aset', 'aset.Nama_Aset', 'ruangan.Nama_Ruangan')
                        ->leftJoin('ruangan', 'ruangan.ID_Ruangan', '=', 'aset.Kode_Aset')
                        ->get()
        );

        return view('Pemeliharaan.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Aset
        $aset = Aset::find($request->Aset_ID);
        $aset->Status = 2;
        $aset->save();

        // Upload Gambar
        if($request->file('Foto_Aset') == '') 
        {
            $avatar = '';
        } else {
            //Change Path of Picture
            $file = $request->file('Foto_Aset');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak; 

            // Croping Picture
            $image_resize = Image::make($file->getRealPath());              
            $image_resize->resize(200, 200);
            $image_resize->save(public_path('data/Foto-Pemeliharaan/' . $fileName));
            $avatar = $fileName;
        }

        $request->request->add(['Tanggal_Pemeliharaan' => Carbon::now()->format('Y-m-d')]);
        $request->request->add(['Foto' => $avatar]);
        $request->request->add(['Status' => 1]);
        $pemeliharaan = Pemeliharaan::create($request->all());

        if($pemeliharaan)
            return redirect('/pemeliharaan')->with('message', 'Pemeliharaan Berhasil dilakukan');
        else 
            return back()->with('message', 'Terjadi kesalahan pada proses pemeliharaan');
        // return $request;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Pemeliharaan::select('pemeliharaan.*', 'aset.Nama_Aset')
                ->leftJoin('aset', 'aset.Kode_Aset', '=', 'pemeliharaan.Kode_Pemeliharaan')
                ->where('pemeliharaan.Kode_Pemeliharaan', '=', $id)
                ->first();
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
            'title' => 'Pemeliharaan Aset',
            'aset' => Aset::select('aset.Kode_Aset', 'aset.Nama_Aset', 'ruangan.Nama_Ruangan')
                        ->leftJoin('ruangan', 'ruangan.ID_Ruangan', '=', 'aset.Kode_Aset')
                        ->get(),
            'pemeliharaan' => Pemeliharaan::find($id)
        );

        return view('Pemeliharaan.edit', compact('data'));
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
        // Pemeliharaan
        $pemeliharaan = Pemeliharaan::find($id);

        // Upload Gambar
        if($request->file('Foto_Aset') != '') 
        {
            //Change Path of Picture
            $file = $request->file('Foto_Aset');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak; 
    
            // Croping Picture
            $image_resize = Image::make($file->getRealPath());              
            $image_resize->resize(200, 200);
            $image_resize->save(public_path('data/Foto-Pemeliharaan/' . $fileName));
            $avatar = $fileName;
            $pemeliharaan->Foto = $avatar;
        }

        // Update
        $pemeliharaan->Aset_ID = $request->Aset_ID;
        $pemeliharaan->Kerusakan = $request->Kerusakan;
        $pemeliharaan->Faktor = $request->Faktor;
        $pemeliharaan->Pemeliharaan = $request->Pemeliharaan;
        $pemeliharaan->Jumlah = $request->Jumlah;
        $pemeliharaan->save();


        if($pemeliharaan)
            return redirect('/pemeliharaan')->with('message', 'Data Pemeliharaan Berhasil diubah');
        else 
            return back()->with('message', 'Terjadi kesalahan pada proses perubahan pemeliharaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemeliharaan = Pemeliharaan::find($id);
        $pemeliharaan->delete();
    }
}
