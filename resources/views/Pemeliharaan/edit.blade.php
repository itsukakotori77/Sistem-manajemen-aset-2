@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{ $data['title'] }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Data</a></div>
                <div class="breadcrumb-item">{{ $data['title'] }}</div>
            </div>
        </div>


        <div class="section-body">
            <h2 class="section-title">
                {{ $data['title'] }}
                <div class="float-right">
                    <a href="{{ url('/pemeliharaan') }}" class="btn btn-primary"><strong>KEMBALI</strong></a>
                </div>
            </h2>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header" style="width: 100%">
                            <div class="float-left">
                                <h4>{{ $data['title'] }}</h4>
                            </div>
                        </div>
                        
                        <!-- Form -->
                        <form action="{{ url('/pemeliharaan/' . $data['pemeliharaan']->Kode_Pemeliharaan . '/edit') }}" method="POST" autocomplete="off" enctype="multipart/form-data" id="form-pemeliharaan">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <!-- Input Hidden -->

                            @if(session('message'))
                                <div class="alert alert-danger" role="alert">
                                    <i class="fa fa-bell"></i>
                                    {{ session('message') }}
                                </div>
                            @endif

                            <div class="card-body">
                                <!-- Nama Aset -->
                                <div class="row">
                                    <!-- Nama Aset -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Nama Aset <span style="color: #FF0000;">*</span></label>
                                            <select name="Aset_ID" id="Aset_ID" class="form-control">
                                                <option selected="selected" disabled>-- Pilih --</option>
                                                @foreach($data['aset'] as $aset)
                                                    <option value="{{ $aset->Kode_Aset }}" @if($data['pemeliharaan']->Aset_ID === $aset->Kode_Aset) selected="selected" @endif>{{ $aset->Nama_Aset . ' (' . $aset->Nama_Ruangan . ')' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Kerusakan -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Kerusakan <span style="color: #FF0000;">*</span></label>
                                            <input type="text" class="form-control" required name="Kerusakan" placeholder="Kerusakan" value="{{ $data['pemeliharaan']->Kerusakan }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- Akibat yang terjadi -->
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="">Faktor <span style="color: #FF0000;">*</span></label>
                                            <textarea type="text" class="form-control" required name="Faktor" placeholder="Faktor">{{ $data['pemeliharaan']->Faktor }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Pemeliharaan yang harus dilakukan <span style="color: #FF0000;">*</span></label>
                                            <textarea type="text" class="form-control" required name="Pemeliharaan" placeholder="Pemeliharaan yang harus dilakukan">{{ $data['pemeliharaan']->Pemeliharaan }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Jumlah -->
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="">Jumlah <span style="color: #FF0000;">*</span></label>
                                            <input type="number" min="1" class="form-control" required name="Jumlah" placeholder="Jumlah" value="{{ $data['pemeliharaan']->Jumlah }}">
                                        </div>
                                    </div>

                                </div>
                                <!-- Upload Foto -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Upload Foto">Upload Foto</label>
                                            <input type="file" class="form-control uploads" id="Foto" name="Foto_Aset" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="text-center">
                                                <label for="avatar">Foto</label>
                                                <br>
                                                <img class="product" id="avatar" src="{{ asset('data/Foto-Pemeliharaan/' . $data['pemeliharaan']->Foto) }}" width="250" height="200">          
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <!-- button -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="float-right">
                                            <button type="reset" class="btn btn-danger btn-sm">RESET PENGAJUAN</button>
                                            <button type="submit" class="btn btn-success btn-sm">SIMPAN</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection 