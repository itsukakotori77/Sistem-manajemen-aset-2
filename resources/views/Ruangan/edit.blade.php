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
                    <a href="{{ url('/ruangan') }}" class="btn btn-primary"><strong>KEMBALI</strong></a>
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
                        <form action="{{ url('/ruangan/' . $data['ruangan']->ID_Ruangan . '/edit') }}" method="POST" autocomplete="off" id="formRuangan">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <!-- Nama Ruangan -->
                                        <div class="form-group">
                                            <label for="">Nama Ruangan <span style="color: #FF0000">*</span></label>
                                            <input type="text" required class="form-control" name="Nama_Ruangan" id="Nama_Ruangan" placeholder="Nama Ruangan" value="{{ $data['ruangan']->Nama_Ruangan }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <!-- button -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="float-right">
                                            <button type="reset" class="btn btn-danger btn-sm">RESET RUANGAN</button>
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