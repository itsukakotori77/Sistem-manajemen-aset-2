<?php

namespace App\Http\Controllers;

use Datatables;
use App\Model\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Pengelolaan Ruangan';
        $data = Ruangan::latest()->get();

        if($request->ajax())
        {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('Jenis_Ruangan', function($data){
                        if($data->Jenis_Ruangan === 1)
                        {
                            $ruangan = 'Ruang Kelas';
                        }else{
                            $ruangan = 'Ruang Praktek';
                        }

                        return $ruangan;
                    })
                    ->addColumn('Aksi', function($data){
                        $aksi = 
                        '
                            <div class="text-center">
                                <div class="dropdown d-inline mr-2">
                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="' . url('/ruangan/' . $data->ID_Ruangan . '/edit') . '">Edit</a>
                                        <a class="dropdown-item" onclick="hapusRuangan(' . $data->ID_Ruangan . ')" href="#">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        ';

                        return $aksi;
                    })
                    ->rawColumns(['Kode_Ruangan', 'Aksi'])
                    ->make(True);
        }

        return view('Ruangan.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'title' => 'Pengelolaan Ruangan'
        );
        
        return view('Ruangan.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ruangan = Ruangan::where('ID_Ruangan', '=', $request->ID_Ruangan)->first();
        
        if($ruangan)
        {
            return back()->with('message', 'Data ruangan sudah ada di database');
        }else{
            Ruangan::create($request->all());
            return redirect('/ruangan')->with('message', 'Data ruangan berhasil ditambahka');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'title' => 'Pengelolaan Ruangan',
            'ruangan' => Ruangan::find($id)
        );

        return view('Ruangan.edit', compact('data'));
        // return $data;
        // return response()->json($data);
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
        $ruangan = Ruangan::find($id);
        // $ruangan->Kode_Ruangan = $request->Kode_Ruangan;
        $ruangan->Nama_Ruangan = $request->Nama_Ruangan;
        // $ruangan->Jenis_Ruangan = $request->Jenis_Ruangan;
        $ruangan->save();

        return redirect('/ruangan')->with('message', 'Data ruangan berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruangan = Ruangan::where('ID_Ruangan', '=', $id)->first();
        $ruangan->delete();
    }
}
