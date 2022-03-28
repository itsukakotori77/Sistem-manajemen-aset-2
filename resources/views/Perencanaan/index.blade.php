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
                    <a href="{{ url('/perencanaan/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> <strong>TAMBAH</strong></a>
                </div>
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
                                        <!-- <th>Jenis Aset</th> -->
                                        <th>Jumlah Aset</th>
                                        <th>Tanggal</th>
                                        <th>Ruangan</th>
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

    @include('Perencanaan.modal')

@endsection 

@push('custom-script')

    <script>

        var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ url('/perencanaan') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'Nama_Aset', name: 'Nama_Aset' },
                // { data: 'Jenis_Aset', name: 'Jenis_Aset' },
                { data: 'Jumlah_Aset', name: 'Jumlah_Aset' },
                { data: 'Tanggal_Perencanaan', name: 'Tanggal_Perencanaan' },
                { data: 'Ruangan', name: 'Ruangan' },
                { data: 'Status', name: 'Status' },
                { data: 'Aksi', name: 'Aksi' },
            ]
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

        function show(id)
        {
            $.ajax({
                url: "{{ url('/perencanaan') }}" + "/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#Nama_Perencanaan').val(data.Nama_Perencanaan);
                    $('#Nama_Pengaju').val(data.Nama_Pengaju);
                    $('#Merek_Aset').val(data.Merek_Aset);
                    $('#Harga_Satuan').val(data.Satuan_Harga);
                    $('#Jumlah_Aset').val(data.Jumlah_Aset);
                    $('#Total_Harga').val(data.Total_Harga);
                    $('#Alasan').val(data.Alasan);
                    $('#modal').modal('show');
                }
            });
        }

        function deleteData(id)
        {
            csrf_token = $('meta[name=csrf_token]').attr('content');

            Swal.fire({
                title: 'Perhatian!',
                text: 'Apakah anda ingin menghapus perencanaan ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/perencanaan') }}" + "/" + id,
                        type: "POST",
                        data: {'_method' : 'DELETE', '_token' : csrf_token},
                        success: function(response)
                        {
                            setTimeout(function() {
                                $.bootstrapGrowl('Perencanaan anda telah dihapus', 
                                { 
                                    type: 'success',
                                    width: '300px;', 
                                });
                            }, 1000);
                            
                        }
                    });
                    table.ajax.reload();
                }
            })
        }
        
    </script>

@endpush 