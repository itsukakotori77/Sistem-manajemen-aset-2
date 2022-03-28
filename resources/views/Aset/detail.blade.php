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
                    <a href="{{ url('/aset/data/masuk') }}" class="btn btn-primary"><strong>KEMBALI</strong></a>
                </div>
            </h2>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header" style="width: 100%">
                            <h4>{{ $data['title'] }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <!-- Form -->
                                    <div class="col-sm-6">
                                        <!-- Kode Aset -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Kode Aset</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Kode_Aset" name="Kode_Aset">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Nama Aset -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Nama Aset</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Nama_Aset" name="Nama_Aset">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Merek Aset -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Merek Aset</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Merek_Aset" name="Merek_Aset">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Kondisi -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Kondisi</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Kondisi" name="Kondisi">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tahun -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Tahun</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Tahun" name="Tahun">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Lokasi Aset -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Lokasi Aset</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Lokasi_Aset" name="Lokasi_Aset">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Kuantitas -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Kuantitas</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Kuantitas" name="Kuantitas">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Satuan Harga -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Satuan Harga</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Satuan_Harga" name="Satuan_Harga">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Total Harga -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Total Harga</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Total_Harga" name="Total_Harga">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Kerusakan -->
                                    <div class="col-sm-6">
                                        <!-- Foto -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <div class="form-group">
                                                        <img class="product" id="avatar" width="250" height="200">          
                                                        <br>
                                                        <label for="avatar">Foto</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Kerusakan -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Kerusakan</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Kerusakan" name="Kerusakan">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Faktor -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Faktor</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Faktor" name="Faktor">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Pemeliharaan -->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">Pemeliharaan</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" id="Pemeliharaan" name="Pemeliharaan">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection 