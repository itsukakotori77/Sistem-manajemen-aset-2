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
                        <div class="card-body">
                            <form action="{{ url('/aset') }}" method="POST" id="formAset" autocomplete="off" enctype="multipart/form-data">
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

                                    <!-- Input Hidden -->
                                    <input type="hidden" id="Total" name="Total">

                                    <!-- Nama -->
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="">Kode Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" required class="form-control" maxlength="6" id="Kode" name="Kode" placeholder="Kode Aset">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="">Nama Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" required class="form-control only-string"  id="Nama_Aset" name="Nama_Aset" placeholder="Nama Aset">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="">Merek Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" required class="form-control"  id="Merek_Aset" name="Merek_Aset" placeholder="Merek Aset">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="">Sumber Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <select name="Sumber_Aset" id="Sumber_Aset" class="form-control">
                                                    <option selected="selected" disabled>-- Pilih Sumber --</option>
                                                    <option value="1">Sekolah</option>
                                                    <option value="2">Pemerintah</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Jumlah Aset -->
                                        <div class="col-sm-2">
                                            <label for="">Jumlah Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="number" min="1" required class="form-control only-number" oninput="total()"  id="Jumlah_Aset" name="Jumlah_Aset" placeholder="Jumlah Aset">
                                            </div>
                                        </div>
                                        <!-- Harga Aset -->
                                        <div class="col-sm-5">
                                            <label for="">Harga Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" required class="form-control only-number" oninput="total()" id="Harga_Aset" name="Harga_Aset" placeholder="Harga Aset">
                                            </div>
                                        </div>
                                        <!-- Kondisi Aset -->
                                        <div class="col-sm-5">
                                            <label for="">Kondisi Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <select type="text" required class="form-control custom-select2"  id="Kondisi_Aset" name="Kondisi_Aset" placeholder="Kondisi Aset" style="width: 100%">
                                                    <option disabled selected="selected">-- Pilih Kondisi --</option>
                                                    <option value="1">Baru</option>
                                                    <option value="2">Bekas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tanggal Penentuan -->
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- Tanggal Masuk -->
                                            <div class="form-group">
                                                <label for="">Tanggal Masuk <span style="color: #FF0000;">*</span></label>
                                                <input type="text" required class="form-control date-picker" id="Tanggal_Masuk" name="Tanggal_Masuk_Input" placeholder="Tanggal Masuk dd/mm/YYYY">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- Pengajuan -->
                                            <div class="form-group">
                                                <label for="">Ruangan <span style="color: #FF0000;"></span></label>
                                                <select name="Ruangan_ID" id="Ruangan_ID" class="form-control custom-select2" style="width: 100%">
                                                    <option selected="selected" disabled>-- Pilih --</option>
                                                    @foreach($data['ruangan'] as $ruangan)
                                                        <option value="{{ $ruangan->ID_Ruangan }}">{{ $ruangan->Nama_Ruangan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
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
                                                <label for="Keterangan">Keterangan <span style="color: #FF0000;">*</span></label>
                                                <div class="form-line">
                                                    <textarea name="Keterangan" required class="form-control" id="Keterangan" cols="30" rows="5" placeholder="Keterangan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- Upload Foto -->
                                            <div class="form-group">
                                                <label for="avatar">Foto</label>
                                                <br>
                                                <img class="product" id="avatar" width="100%" height="100%">          
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

            // // Datepicker
            // $('.date-picker').datepicker({
            //     language: 'en',
            //     autoClose: true,
            //     dateFormat: 'dd MM yyyy',
            //     minDate: new Date()
            // });
            
            // $('#Tanggal_Pembuatan').datepicker({
            //     language: 'en',
            //     autoClose: true,
            //     dateFormat: 'dd MM yyyy',
            // });
            $('.date-picker').daterangepicker({
                locale: {format: 'DD-MM-YYYY'},
                singleDatePicker: true,
                minDate: new Date(),
                // startDate: new Date(),
            });

        });
        // Set Date
        $('#Tanggal_Masuk').on('changeDate', function(selected) {
            var startDate = new Date(selected.date.valueOf());
            $('#Tanggal_Keluar').datepicker('setStartDate', startDate);
            
            if( lengthDate($('#Tanggal_Masuk').val()) > lengthDate($('#Tanggal_Keluar').val()) ){
                $('#Tanggal_Keluar').val($('#Tanggal_Masuk').val());
            }
        });

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

        // Message
        @if(session('message'))
            setTimeout(function() {
                $.bootstrapGrowl("{{ session('message') }}", 
                { 
                    type: 'warning',
                    width: '300px;', 
                });
            }, 1000);
        @endif

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

        function lengthDate(date)
        {
            var parts = date.split("/");
            return new Date(parts[2], parts[1] - 1, parts[0]);
        }

        function total()
        {
            $('#Total').val(parseInt( $('#Jumlah_Aset').val() * $('#Harga_Aset').val() ));
        }

    </script>

@endpush