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
                    <a href="{{ url('/pegawai') }}" class="btn btn-primary"><strong>KEMBALI</strong></a>
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
                        
                        <form action="{{ url('/pegawai/' . $data['pegawai']->ID_Pegawai . '/edit') }}" method="POST" id="formPegawai" autocomplete="off" enctype="multipart/form-data" autocomplete="off">
                            <div class="card-body">
                                <div class="container">
                                    <!-- Kondisi -->
                                    @if(session('message'))
                                        <div class="alert alert-danger" role="alert">
                                            <i class="fa fa-bell"></i>
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <!-- Token -->
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <!-- Nama -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="">Nama Depan <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" class="form-control only-string"  id="Nama_Depan" name="Nama_Depan" placeholder="Nama Depan" value="{{ $data['pegawai']->Nama_Depan }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">Nama Belakang <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" class="form-control only-string"  id="Nama_Belakang" name="Nama_Belakang" placeholder="Nama Belakang" value="{{ $data['pegawai']->Nama_Belakang }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- NIP -->
                                            <div class="form-group">
                                                <label for="">Nomor Induk Pegawai <span style="color: #FF0000;">*</span></label>
                                                <input type="text" class="form-control only-number" id="NIP" name="NIP" minlength="12" placeholder="NIP" value="{{ $data['pegawai']->NIP }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- Jenis Kelamin -->
                                            <div class="form-group">
                                                <label for="">Jenis Kelamin <span style="color: #FF0000;">*</span></label>
                                                <select name="Jenis_Kelamin"  id="Jenis_Kelamin" class="form-control custom-select2" style="width: 100%">
                                                    <option selected disabled>-- Pilih --</option>
                                                    <option value="1" @if($data['pegawai']->Jenis_Kelamin === 1) selected="selected" @endif>Laki - laki</option>
                                                    <option value="2" @if($data['pegawai']->Jenis_Kelamin === 2) selected="selected" @endif>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- Role -->
                                            <div class="form-group">
                                                <label for="">Pilih Role <span style="color: #FF0000;">*</span></label>
                                                <select name="Role"  id="Role" class="form-control custom-select2" style="width: 100%">
                                                    <option selected disabled>-- Pilih --</option>
                                                    @foreach($data['role'] as $role )
                                                        <option value="{{ $role->id }}" @if($data['user']->role_id === $role->id) selected="selected" @endif>{{ $role->role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="form-group form-float">
                                        <label for="Alamat">Alamat <span style="color: #FF0000;">*</span></label>
                                        <div class="form-line">
                                            <textarea name="Alamat" required class="form-control" id="Alamat" cols="30" rows="10" placeholder="Alamat">{{ $data['pegawai']->Alamat }}</textarea>
                                        </div>
                                    </div>

                                    <!-- TTL -->
                                    <div class="row">
                                        <!-- Tempat Lahir -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Tempat Lahir <span style="color: #FF0000;">*</span></label>
                                                <input type="text" class="form-control"  id="Tempat_Lahir" name="Tempat_Lahir" placeholder="Tempat Lahir" value="{{ $data['pegawai']->Tempat_Lahir }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Tanggal Lahir <span style="color: #FF0000;">*</span></label>
                                                <input type="text" class="form-control datepicker" id="Tanggal_Lahir" name="Tanggal_Lahir" placeholder="Tanggal Lahir dd/mm/YYYY" value="{{ date('d/m/Y', strtotime($data['pegawai']->Tanggal_Lahir)) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- Username -->
                                            <div class="form-group">
                                                <label for="">Username <span style="color: #FF0000;">*</span></label>
                                                <input type="text" class="form-control only-lowercase" id="Username" name="Username" placeholder="Username" value="{{ $data['user']->username }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- Email -->
                                            <div class="form-group">
                                                <label for="">Email <span style="color: #FF0000;">*</span></label>
                                                <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" readonly value="{{ $data['user']->email }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Upload Foto -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="Upload Foto">Upload Foto</label>
                                                <input type="file" class="form-control uploads" id="Foto" name="Foto_Avatar" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="avatar">Foto</label>
                                                <br>
                                                <img class="product" id="avatar" width="250" height="200" src="{{ asset('assets/img/foto-user/' . $data['pegawai']->Foto ) }}">          
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <div class="float-right">
                                        <button type="reset" class="btn btn-danger btn-sm"><strong>RESET</strong></button>
                                        <button type="submit" class="btn btn-success btn-sm"><strong>SUBMIT</strong></button>
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