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
                    <a href="{{ url('/pegawai/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> <strong>TAMBAH</strong></a>
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
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Username</th>
                                        <th>Jabatan</th>
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
            ajax: "{{ url('/pegawai') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'Foto', name: 'Foto' },
                { data: 'Nama', name: 'Nama' },
                { data: 'Jenis_Kelamin', name: 'Jenis_Kelamin' },
                { data: 'Username', name: 'Username' },
                { data: 'Role', name: 'Role' },
                // { data: 'Alamat', name: 'Alamat' },
                // { data: 'Tempat_Lahir', name: 'Tempat_Lahir' },
                // { data: 'Tanggal_Lahir', name: 'Tanggal_Lahir' },
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

        function showData(id)
        {
            $.ajax({
                url: "{{ url('/pegawai') }}" + "/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    // alert(data.user.username);
                    $('#Name').text(data.pegawai.Nama_Depan + ' ' + data.pegawai.Nama_Belakang);
                    $('#Username_User').text(data.user.username);
                    $('#Email_User').text(data.user.email);

                    // Kondisi
                    if(data.user.role_id == 1)
                        $('#Role_User').text('Admin');
                    else if(data.user.role_id == 2)
                        $('#Role_User').text('Ketua Kompentensi');
                    else if(data.user.role_id == 3)
                        $('#Role_User').text('Sarpras');
                    else if(data.user.role_id == 4)
                        $('#Role_User').text('Pengguna Aset');
                    else if(data.user.role_id == 5)
                        $('#Role_User').text('TU Aset');
                    else if(data.user.role_id == 6)
                        $('#Role_User').text('Guru');
                    
                    // Alamat
                    $('#Alamat_User').text(data.pegawai.Alamat);

                    // Foto
                    if(data.pegawai.Foto == '')
                        $('#foto-user').attr('src', "https://ui-avatars.com/api/?name=. $data->Nama_Depan . + . $data->Nama_Belakang . &background=0D8ABC&color=fff");
                    else 
                        $('#foto-user').attr('src', "{{ asset('assets/images/foto-user') }}" + "/" + data.pegawai.Foto);
                    
                    $('#modal').modal('show');
                }
            });

        }

        function ubahStatus(id)
        {
            // code block
            csrf_token = $('meta[name=csrf_token]').attr('content');

            Swal.fire({
                title: 'Perhatian!',
                text: 'Apakah anda ingin mengubah status pegawai ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/user') }}" + "/" + id + "/status",
                        type: "POST",
                        data: {'_method' : 'PUT', '_token' : csrf_token},
                        success: function(response)
                        {
                            setTimeout(function() 
                            {
                                $.bootstrapGrowl('Status berhasil diubah', 
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