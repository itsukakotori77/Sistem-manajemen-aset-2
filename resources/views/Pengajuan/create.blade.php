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
                    <a href="{{ url('/pengajuan') }}" class="btn btn-primary"><strong>KEMBALI</strong></a>
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
                        <form action="{{ url('/pengajuan') }}" method="POST" autocomplete="off" id="formPengajuan">
                            {{ csrf_field() }}

                            <div class="card-body">

                                <!-- Input -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Nama Pengajuan -->
                                        <div class="form-group">
                                            <label for="">Nama Pengajuan <span style="color: #FF0000;">*</span></label>
                                            <input type="text" class="form-control" name="Nama_Pengajuan" required id="Nama_Pengajuan" placeholder="Nama Pengajuan">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Tanggal Pengajuan -->
                                        <div class="form-group">
                                            <label for="">Tanggal Pengajuan <span style="color: #FF0000;">*</span></label>
                                            <input type="text" class="form-control date-picker" name="Tanggal_Pengajuan" required id="Tanggal_Pengajuan" placeholder="Tanggal Pengajuan">
                                        </div>
                                    </div>
                                </div>

                                <!-- Input Perencanaan -->
                                <div class="form-group">
                                    <label class="weight-600">Pengajuan minggu ini <span style="color: #FF0000;">*</span></label>
                                    @if(count($data['perencanaan']) > 0)
                                        @foreach($data['perencanaan'] as $perencanaan)
                                            <div class="custom-control custom-checkbox mb-5">
                                                <input type="checkbox" name="Perencanaan[]" required class="custom-control-input" id="Perencanaan{{ $loop->iteration }}" value="{{ $perencanaan->Kode_Perencanaan }}">
                                                <label class="custom-control-label" for="Perencanaan{{ $loop->iteration }}">{{ $perencanaan->Nama_Perencanaan }}</label>
                                            </div>
                                        @endforeach
                                    @else 
                                        <h5 style="color: #FF0000;">Tidak ada perencanaan aset</h5>
                                    @endif
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

@push('custom-script')

    <script>
        // Jquery Validator
        $("#formPengajuan").validate({
            // Rules
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                // Add Class
                $('.form-group').addClass('has-danger');
            }
        });
        
        $('.date-picker').daterangepicker({
            locale: {format: 'DD-MM-YYYY'},
            singleDatePicker: true,
            minDate: new Date(),
            // startDate: new Date(),
        });
    </script>

@endpush