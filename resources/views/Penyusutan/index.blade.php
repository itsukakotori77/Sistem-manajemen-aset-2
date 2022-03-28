@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Data</a></div>
                <div class="breadcrumb-item">{{ $title }}</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                {{ $title }}
                <!-- <div class="float-right">
                    <a href="{{ url('/pengajuan/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> <strong>TAMBAH</strong></a>
                </div> -->
            </h2>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header" style="width: 100%">
                            <div class="float-left">
                                <h4>{{ $title }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Aset</th>
                                        <th>Tanggal Penyusutan</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>   
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection 

@push('custom-script')

    
    <script>

        var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ url('/penyusutan') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'Nama_Aset', name: 'Nama_Aset' },
                { data: 'Tanggal_Penyusutan', name: 'Tanggal_Penyusutan' },
                { data: 'Tanggal_Masuk', name: 'Tanggal_Masuk' },
                { data: 'Status', name: 'Status' },
            ]
        });
        

    </script>

@endpush 