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

                @if($method === 'masuk')
                    <div class="float-right">
                        <a href="{{ url('/aset/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> <strong>TAMBAH</strong></a>
                    </div>
                @endif 
            </h2>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header" style="width: 100%">
                            <div class="float-left">
                                <ul class="nav nav-pills">
                                    <!-- <li class="nav-item">
                                        <a class="nav-link {{ setActive('aset') }}" href="{{ url('/aset') }}">Home</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link {{ setActive('aset/data/masuk') }}" href="{{ url('/aset/data/masuk') }}">Data Aset Masuk</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ setActive('pembelian') }}" href="{{ url('/pembelian') }}">Pengecekan</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table datatable" style="width: 100%;">
                                <thead>
                                    @if($method === 'penetapan')
                                        <tr>
                                            <th>Aset</th>
                                            <th>Nama Aset</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Ruangan</th>
                                            <th>Sumber Aset</th>
                                            <th>Jumlah Penempatan</th>
                                            <th>Status</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>Aset</th>
                                            <th>Nama Aset</th>
                                            <th>Jumlah Aset</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Ruangan</th>
                                            <th>Sumber Aset</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    @endif
                                </thead> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    @include('Aset.modal')

@endsection 

@push('custom-script')

    <script>

        var table1 = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ url('/aset') }}" + "/" + "data" + "/" + "{{ $method }}",
            columns: [
                @if($method === 'penetapan')
                    // { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'Foto', name: 'Foto' },
                    { data: 'Nama_Aset', name: 'Nama_Aset' },
                    { data: 'Tanggal_Masuk', name: 'Tanggal_Masuk' },
                    { data: 'Nama_Ruangan', name: 'Nama_Ruangan' },
                    { data: 'Sumber_Aset', name: 'Sumber_Aset' },
                    { data: 'Jumlah_Aset', name: 'Jumlah_Aset' },
                    { data: 'Status', name: 'Status' },
                @else 
                    { data: 'Foto', name: 'Foto' },
                    { data: 'Nama_Aset', name: 'Nama_Aset' },
                    { data: 'Jumlah_Aset', name: 'Jumlah_Aset' },
                    { data: 'Tanggal_Masuk', name: 'Tanggal_Masuk' },
                    { data: 'Nama_Ruangan', name: 'Nama_Ruangan' },
                    { data: 'Sumber_Aset', name: 'Sumber_Aset' },
                    { data: 'Status', name: 'Status' },
                    { data: 'Aksi', name: 'Aksi' },
                @endif
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
                url: "{{ url('/aset') }}" + "/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.Jenis_Aset === 1)
                        $('#Jenis_Aset').text('Aset Berwujud');
                    else
                        $('#Jenis_Aset').text('Tidak Berwujud');

                    // Input
                    $('#Nama_Aset').text(data.Nama_Aset);
                    $('#Merek_Aset').text('Merek Aset : ' + data.Merek_Aset);
                    $('#Jumlah_Aset').text('Jumlah Aset : ' + data.Jumlah_Aset);
                    $('#Harga_Aset').text('Harga Aset : Rp. ' + data.Harga_Aset);
                    $('#Total_Harga').text('Total Harga Aset : Rp.' + data.Total_Harga);
                    $('#Keterangan').text(data.Keterangan);

                    if(data.QrCode != '')
                    {
                        $('#generate').attr('hidden', true);
                        $('#QrCode_Aset').attr('src', "{{ asset('/data/QrCode-Aset') }}" + "/" + data.QrCode);
                    }else{
                        $('#generate').attr('hidden', false);
                        $('#generate').attr('onclick', 'generate(' + data.Kode_Aset + ')');
                        $('#QrCode_Aset').attr('src', "{{ asset('/data/QrCode-Aset/no-qrcode.png') }}");
                    }

                    $('#modal').modal('show');
                }
            });
            
        }

        function generate(id)
        {
            csrf_token = $('meta[name=csrf_token]').attr('content');

            $.ajax({
                url: "{{ url('/aset') }}" + "/" + id + "/generate" + "/qrcode",
                type: "POST",
                data: {'_method' : 'PUT', '_token' : csrf_token},
                success: function(data)
                {
                    setTimeout(function() 
                    {
                        $.bootstrapGrowl('QrCode telah berhasil dibuat', 
                        { 
                            type: 'success',
                            width: '300px;', 
                        });
                    }, 1000);
                    $('#generate').attr('hidden', true);
                    $('#QrCode_Aset').attr('src', "{{ asset('/data/QrCode-Aset') }}" + "/" + data.QrCode);
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

        function modalIndikator(id)
        {
            $('#form-indikator')[0].reset();
            $('#Kode_Aset').val(id);
            $('#indikator-modal').modal('show');
        }

        function deleteData(id)
        {
            csrf_token = $('meta[name=csrf_token]').attr('content');

            Swal.fire({
                title: 'Perhatian!',
                text: 'Apakah anda ingin menghapus aset ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/aset') }}" + "/" + id,
                        type: "POST",
                        data: {'_method' : 'DELETE', '_token' : csrf_token},
                        success: function(response)
                        {
                            setTimeout(function() {
                                $.bootstrapGrowl('Data aset telah dihapus', 
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


        $('#form-indikator').on('submit', function(e){
            e.preventdefault;

            var id = $('#Kode_Aset').val();

            $.ajax({
                url: "{{ url('/aset') }}" + "/" + id + "/indikator",
                type: "POST",
                data: $('#form-indikator').serialize(),
                success: function(data)
                {
                    $('#indikator-modal').modal('hide');
                    setTimeout(function() {
                        $.bootstrapGrowl("Data indikator baru telah ditambahkan !", 
                        { 
                            type: 'success',
                            width: 'auto', 
                        });
                    }, 1000);
                    table1.ajax.reload();
                }     
            });

            return false;

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


    </script>

@endpush