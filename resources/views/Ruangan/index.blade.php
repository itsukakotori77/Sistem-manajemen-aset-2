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
                    <a href="{{ url('/ruangan/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> <strong>TAMBAH</strong></a>
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
                                        <!-- <th>Kode Ruangan</th> -->
                                        <th>Nama Ruangan</th>
                                        <!-- <th>Jenis Ruangan</th> -->
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
            ajax: "{{ url('/ruangan') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                // { data: 'Kode_Ruangan', name: 'Kode_Ruangan' },
                { data: 'Nama_Ruangan', name: 'Nama_Ruangan' },
                // { data: 'Jenis_Ruangan', name: 'Jenis_Ruangan' },
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

        function hapusRuangan(id)
        {
            csrf_token = $('meta[name=csrf_token]').attr('content');

            Swal.fire({
                title: 'Perhatian!',
                text: 'Apakah anda ingin menghapus ruangan ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/ruangan') }}" + "/" + id,
                        type: "POST",
                        data: {'_method' : 'DELETE', '_token' : csrf_token},
                        success: function(response)
                        {
                            setTimeout(function() {
                                $.bootstrapGrowl('Ruangan telah dihapus', 
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