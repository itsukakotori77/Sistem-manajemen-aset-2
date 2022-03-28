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
                            <div class="float-left">
                                <h4>{{ $data['title'] }}</h4>
                            </div>
                        </div>
                        <form action="{{ url('/aset/' . $data['aset']->Kode_Aset . '/edit') }}" method="POST" id="formAset" autocomplete="off" enctype="multipart/form-data">
                            <div class="container">
                                <!-- Kondisi -->
                                @if(session('message'))
                                    <div class="alert alert-primary" role="alert">
                                        <i class="fa fa-bell"></i>
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <!-- Token -->
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <!-- Input Hidden -->
                                <input type="hidden" id="Total" name="Total" value="{{ $data['aset']->Total_Harga }}">

                                <!-- Nama -->
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="">Kode Aset <span style="color: #FF0000;">*</span></label>
                                        <div class="form-group">
                                            <input type="text" required class="form-control" maxlength="6" id="Kode" name="Kode" placeholder="Kode Aset" value="{{ $data['aset']->Kode }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="">Nama Aset <span style="color: #FF0000;">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control only-string"  id="Nama_Aset" name="Nama_Aset" placeholder="Nama Aset" value="{{ $data['aset']->Nama_Aset }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="">Merek Aset <span style="color: #FF0000;">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control"  id="Merek_Aset" name="Merek_Aset" placeholder="Merek Aset" value="{{ $data['aset']->Merek_Aset }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="">Sumber Aset <span style="color: #FF0000;">*</span></label>
                                        <div class="form-group">
                                            <!-- <input type="number" min="1" required class="form-control"  id="Sumber_Aset" name="Sumber_Aset" placeholder="Umur Ergonomis" value="{{ $data['aset']->Sumber_Aset }}"> -->
                                            <select name="Sumber_Aset" id="Sumber_Aset" class="form-control">
                                                <option selected="selected" disabled>-- Pilih Sumber --</option>
                                                <option value="1" @if($data['aset']->Sumber_Aset === 1) selected="selected" @endif>Sekolah</option>
                                                <option value="2" @if($data['aset']->Sumber_Aset === 2) selected="selected" @endif>Pemerintah</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Jumlah Aset -->
                                    <div class="col-sm-2">
                                        <label for="">Jumlah Aset <span style="color: #FF0000;">*</span></label>
                                        <div class="form-group">
                                            <input type="number" min="1" class="form-control only-number" oninput="total()"  id="Jumlah_Aset" name="Jumlah_Aset" placeholder="Jumlah Aset" value="{{ $data['aset']->Jumlah_Aset }}">
                                        </div>
                                    </div>
                                    <!-- Harga Aset -->
                                    <div class="col-sm-5">
                                        <label for="">Harga Aset <span style="color: #FF0000;">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control only-number" oninput="total()" id="Harga_Aset" name="Harga_Aset" placeholder="Harga Aset" value="{{ $data['aset']->Harga_Aset }}">
                                        </div>
                                    </div>
                                    <!-- Kondisi Aset -->
                                    <div class="col-sm-5">
                                        <label for="">Kondisi Aset <span style="color: #FF0000;">*</span></label>
                                        <div class="form-group">
                                            <select type="text" class="form-control custom-select2" required id="Kondisi_Aset" name="Kondisi_Aset" placeholder="Kondisi Aset" style="width: 100%">
                                                <option disabled selected="selected">-- Pilih Kondisi --</option>
                                                <option value="1" @if($data['aset']->Kondisi_Aset === 1) selected="selected" @endif>Baru</option>
                                                <option value="2" @if($data['aset']->Kondisi_Aset === 2) selected="selected" @endif>Bekas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tanggal Penentuan -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Tanggal Masuk -->
                                        <div class="form-group">
                                            <label for="">Tanggal Masuk <span style="color: #FF0000;">*</span></label>
                                            <input type="text" class="form-control date-picker" id="Tanggal_Masuk" name="Tanggal_Masuk_Input" placeholder="Tanggal Masuk dd/mm/YYYY" value="{{ date('d/m/Y', strtotime($data['aset']->Tanggal_Masuk)) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="Upload Foto">Upload Foto</label>
                                        <div class="form-group">
                                            <input type="file" class="form-control uploads" id="Foto" name="Foto_Aset" accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <!-- Keterangan -->
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="Keterangan">Keterangan</label>
                                            <div class="form-line">
                                                <textarea name="Keterangan" class="form-control" id="Keterangan" cols="30" rows="5" placeholder="Keterangan">{{ $data['aset']->Keterangan }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Upload Foto -->
                                        <div class="form-group">
                                            <label for="avatar">Foto</label>
                                            <br>
                                            <img class="product" id="avatar" src="{{ asset('data/Foto-Aset/' . $data['aset']->Foto) }}" width="100%" height="100%">          
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <div class="float-right">
                                        <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
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

@push('custom-script')

    <script>
        $(function(){
            $('.uploads').change(readURL)
            $('#f').submit(function(){
                // do ajax submit or just classic form submit
                //  alert("fake subminting")
                return false;
            });  
        })

        // Jquery Validator
        $("#formAset").validate({
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                // Add Class
                $('.form-group').addClass('has-danger');
                // $('.form-control').addClass('form-control-danger');
            }
        });

        $('.date-picker').daterangepicker({
            locale: {format: 'DD-MM-YYYY'},
            singleDatePicker: true,
            minDate: new Date(),
            // startDate: new Date(),
        });

        function readURL() 
        {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatar').attr('src', e.target.result);
                    var croppr = new Cropper('#avatar', {
                        onInitialize: (instance) => { console.log(instance); },
                        onCropStart: (data) => { console.log('start', data); },
                        onCropEnd: (data) => { console.log('end', data); },
                        onCropMove: (data) => { console.log('move', data); }
                    });

                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function total()
        {
            $('#Total').val(parseInt( $('#Jumlah_Aset').val() * $('#Harga_Aset').val() ));
        }
    </script>

@endpush 