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

                        <form action="{{ url('/perencanaan/' . $data['perencanaan']->Kode_Perencanaan . '/edit') }}" method="POST" autocomplete="off" id="formPerencanaan">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="card-body">
                                <!-- Input Hidden -->
                                <input type="hidden" name="Nama_Pengaju">

                                <div class="row">
                                    <!-- Nama Perencanaan -->
                                    <div class="col-sm-4">
                                        <div class="form-group">    
                                            <label for="">Nama Perencanaan <span style="color: #FF0000">*</span> </label>
                                            <input type="text" class="form-control" id="Nama_Perencanaan" name="Nama_Perencanaan" placeholder="Nama Perencanaan" value="{{ $data['perencanaan']->Nama_Perencanaan }}">
                                        </div>
                                    </div>
                                    <!-- Nama Pengaju -->
                                    <div class="col-sm-4">
                                        <label for="">Nama Pengaju <span style="color: #FF0000">*</span></label>
                                        <input type="text" class="form-control" id="Nama_Pengaju" name="Nama_Pengaju" placeholder="Nama Pengaju" value="{{ $data['perencanaan']->Nama_Pengaju }}">
                                    </div>
                                    <!-- Ruangan -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="">Ruangan <span style="color: #FF0000">*</span></label>
                                            <select id="Ruangan" style="width: 100%" name="Ruangan" class="form-control custom-select2">
                                                <option selected="selected" disabled>-- Pilih --</option>
                                                @foreach($data['ruangan'] as $ruangan)
                                                    <option value="{{ $ruangan->ID_Ruangan }}" @if($data['perencanaan']->Ruangan_ID === $ruangan->ID_Ruangan) selected="selected" @endif>{{ $ruangan->Nama_Ruangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Aset -->
                                <div class="row">
                                    <!-- Nama Aset -->
                                    <div class="col-sm-12">
                                        <div class="form-group">    
                                            <label for="">Nama Aset <span style="color: #FF0000">*</span> </label>
                                            <input type="text" class="form-control" id="Nama_Aset" name="Nama_Aset" placeholder="Nama Aset" value="{{ $data['perencanaan']->Nama_Aset }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Merk Aset -->
                                <div class="row">
                                    <div class="col-sm-8">
                                        <!-- Merek Aset -->
                                        <div class="form-group">
                                            <label for="">Merek Aset <span style="color: #FF0000">*</span> </label>
                                            <input type="text" class="form-control" name="Merek_Aset" id="Merek_Aset" placeholder="Merek Aset" value="{{ $data['perencanaan']->Merek_Aset }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Jumlah Aset -->
                                        <div class="form-group">
                                            <label for="">Kuantitas <span style="color: #FF0000">*</span> </label>
                                            <input type="number" onkeyup="total()" min="1" class="form-control" id="Kuantitas" name="Kuantitas" placeholder="Jumlah Aset" value="{{ $data['perencanaan']->Jumlah_Aset }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Harga -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Satuan Harga -->
                                        <div class="form-group">
                                            <label for="">Satuan Harga <span style="color: #FF0000">*</span> </label>
                                            <input type="text" onkeyup="total()" class="form-control only-number" name="Satuan_Harga" id="Satuan_Harga" placeholder="Satuan Harga" value="{{ $data['perencanaan']->Satuan_Harga }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Total Harga -->
                                        <div class="form-group">
                                            <label for="">Total Harga <span style="color: #FF0000">*</span> </label>
                                            <input type="text" class="form-control only-number" name="Total_Harga" id="Total_Harga" placeholder="Total Harga" readonly value="{{ $data['perencanaan']->Total_Harga }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Alasan -->
                                <div class="form-group">
                                    <label for="">Alasan Perencanaan <span style="color: #FF0000">*</span> </label>
                                    <textarea class="form-control" name="Alasan" id="Alasan" cols="30" rows="5" placeholder="Alasan Perencanaan">{{ $data['perencanaan']->Alasan }}</textarea>
                                </div>

                            </div>

                            <div class="card-footer">
                                <!-- button -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="float-right">
                                            <button type="reset" class="btn btn-danger btn-sm"><strong>RESET PERENCANAAN</strong></button>
                                            <button type="submit" class="btn btn-success btn-sm"><strong>SIMPAN</strong></button>
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

@push('custom-script')

    <script>
        // Jquery Validator
        $("#formPerencanaan").validate({
            // Rules
            rules: {
                Nama_Perencanaan: "required",
                Nama_Aset: "required",
                Jenis_Aset: "required",
                Merek_Aset: "required",
                Kuantitas: "required",
                Satuan_Harga: "required",
                Total_Harga: "required",
                Alasan: "required",
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('form-control-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                // Add Class
                $('.form-group').addClass('has-danger');
            }
        });


        function total()
        {
            hasil = parseInt($('#Kuantitas').val()) * parseInt($('#Satuan_Harga').val());
            $('#Total_Harga').val( numberWithCommas(hasil) );
        }

        function numberWithCommas(x) 
        {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>

@endpush