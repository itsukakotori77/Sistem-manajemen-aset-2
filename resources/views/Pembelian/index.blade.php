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
                <div class="float-right">
                    <a href="{{ url('/pembelian/indikator') }}" class="btn btn-primary"><i class="fa fa-plus"></i> <strong>TAMBAH</strong></a>
                </div>
            </h2>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header" style="width: 100%">
                            <ul class="nav nav-pills">
                                <!-- <li class="nav-item">
                                    <a class="nav-link {{ setActive('aset') }}" href="{{ url('/aset') }}">Home</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link {{ setActive('/aset/data/masuk') }}" href="{{ url('/aset/data/masuk') }}">Data Aset Masuk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ setActive('pembelian') }}" href="{{ url('/pembelian') }}">Pengecekan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <table class="table datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Aset</th>
                                        <th>Nama Pengajuan</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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
            ajax: "{{ url('/pembelian') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'Nama_Aset', name: 'Nama_Aset' },
                { data: 'Nama_Pengajuan', name: 'Nama_Pengajuan' },
                { data: 'Tanggal_Pengajuan', name: 'Tanggal_Pengajuan' },
                { data: 'Tanggal_Pembelian', name: 'Tanggal_Pembelian' },
                { data: 'Status', name: 'Status' },
                { data: 'Aksi', name: 'Aksi' },
            ],
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0
            } ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },
        });

        
        // Message
        @if(session('message'))
            setTimeout(function() {
                $.bootstrapGrowl("{{ session('message') }}", 
                { 
                    type: 'success',
                    width: '300px;', 
                });
            }, 1000);
        @endif

        function tambahAset(id)
        {
            // code block
            csrf_token = $('meta[name=csrf_token]').attr('content');

            Swal.fire({
                title: 'Perhatian!',
                text: 'Apakah anda ingin menambahkan pengajuan berdasarkan aset ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/pembelian') }}" + "/" + id + "/aset",
                        type: "POST",
                        data: {'_method' : 'POST', '_token' : csrf_token},
                        success: function(response)
                        {
                            setTimeout(function() 
                            {
                                $.bootstrapGrowl('Penambahan aset berhasil dilakukan', 
                                { 
                                    type: 'success',
                                    width: '300px;', 
                                });
                            }, 1000);
                            table.ajax.reload();
                        }
                    });
                }
            });
        }

    </script>

@endpush