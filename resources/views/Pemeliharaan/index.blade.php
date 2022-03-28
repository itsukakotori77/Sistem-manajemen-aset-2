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
                    <a href="{{ url('/pemeliharaan/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> <strong>TAMBAH</strong></a>
                </div>
            </h2>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header" style="width: 100%">
                            <h4>{{ $title }}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Aset</th>
                                        <th>Faktor</th>
                                        <th>Proses Pemeliharaan</th>
                                        <th>Tanggal Pemeliharaan</th>
                                        <th>Jumlah</th>
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

    <!-- Modal -->
    @include('Pemeliharaan.modal')

@endsection 

@push('custom-script')

    <script>
        var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ url('/pemeliharaan') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'Nama_Aset', name: 'Nama_Aset' },
                { data: 'Faktor', name: 'Faktor' },
                { data: 'Pemeliharaan', name: 'Pemeliharaan' },
                { data: 'Tanggal_Pemeliharaan', name: 'Tanggal_Pemeliharaan' },
                { data: 'Jumlah', name: 'Jumlah' },
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

        function show(id)
        {
            $.ajax({
                url: "{{ url('/pemeliharaan') }}" + "/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#Nama_Aset').text('Nama Aset : ' + data.Nama_Aset);
                    $('#Kerusakan').text('Kerusakan ' + data.Kerusakan);
                    $('#Faktor').text('Faktor ' + data.Faktor);
                    $('#Pemeliharaan').text('Pemeliharaan ' + data.Pemeliharaan);

                    if(data.Foto != '')
                        $('#Foto').attr('src', "{{ asset('data/Foto-Pemeliharaan') }}" + "/" + data.Foto)
                    else 
                        $('#Foto').attr('src', "{{ asset('data/Foto-Pemeliharaan/asset.png') }}")
                        
                    $('#modal-pemeliharaan').modal('show');
                }
            });
        }

        function penyusutan(id)
        {
            csrf_token = $('meta[name=csrf_token]').attr('content');

            Swal.fire({
                title: 'Perhatian!',
                text: 'Apakah anda ingin melakukan penyusutan terhadap aset ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/penyusutan') }}" + "/" + id + "/aset",
                        type: "POST",
                        data: {'_method' : 'PUT', '_token' : csrf_token},
                        success: function(response)
                        {
                            setTimeout(function() {
                                $.bootstrapGrowl('Penyusutan berhasil dilakukan', 
                                { 
                                    type: 'success',
                                    width: '300px;', 
                                });
                            }, 1000);
                            
                        }
                    });
                    table1.ajax.reload();
                }
            })
        }

        function hapus(id)
        {
            // code block
            csrf_token = $('meta[name=csrf_token]').attr('content');

            Swal.fire({
                title: 'Perhatian!',
                text: 'Apakah anda ingin menghapus data pemeliharaan ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/pemeliharaan') }}" + "/" + id,
                        type: "POST",
                        data: {'_method' : 'DELETE', '_token' : csrf_token},
                        success: function(response)
                        {
                            setTimeout(function() 
                            {
                                $.bootstrapGrowl('Data berhasil dihapus', 
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