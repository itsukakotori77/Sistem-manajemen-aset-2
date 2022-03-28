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
                        
                        <form action="{{ url('/pegawai') }}" method="POST" id="formPegawai" autocomplete="off" enctype="multipart/form-data" autocomplete="off">
                            <div class="card-body">
                                <div class="container">
                                    <!-- Kondisi -->
                                    @if(session('message'))
                                        <div class="alert alert-danger" role="alert">
                                            <i class="fa fa-bell"></i>
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <!-- Token -->
                                    {{ csrf_field() }}
                                    <!-- Nama -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="">Nama Depan <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" class="form-control only-string"  id="Nama_Depan" name="Nama_Depan" placeholder="Nama Depan">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="">Nama Belakang <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" class="form-control only-string"  id="Nama_Belakang" name="Nama_Belakang" placeholder="Nama Belakang">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- NIP -->
                                            <div class="form-group">
                                                <label for="">Nomor Induk Pegawai <span style="color: #FF0000;">*</span></label>
                                                <input type="text" class="form-control only-number" id="NIP" name="NIP" minlength="12" placeholder="NIP">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- Jenis Kelamin -->
                                            <div class="form-group">
                                                <label for="">Jenis Kelamin <span style="color: #FF0000;">*</span></label>
                                                <select name="Jenis_Kelamin"  id="Jenis_Kelamin" class="form-control custom-select2" style="width: 100%">
                                                    <option selected disabled>-- Pilih --</option>
                                                    <option value="1">Laki - laki</option>
                                                    <option value="2">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- Role -->
                                            <div class="form-group">
                                                <label for="">Pilih Role <span style="color: #FF0000;">*</span></label>
                                                <select name="Role"  id="Role" class="form-control custom-select2" style="width: 100%">
                                                    <option selected disabled>-- Pilih --</option>
                                                    @foreach($data['role'] as $role )
                                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="form-group form-float">
                                        <label for="Alamat">Alamat <span style="color: #FF0000;">*</span></label>
                                        <div class="form-line">
                                            <textarea name="Alamat" required class="form-control" id="Alamat" cols="30" rows="10" placeholder="Alamat"></textarea>
                                        </div>
                                    </div>

                                    <!-- TTL -->
                                    <div class="row">
                                        <!-- Tempat Lahir -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Tempat Lahir <span style="color: #FF0000;">*</span></label>
                                                <input type="text" class="form-control"  id="Tempat_Lahir" name="Tempat_Lahir" placeholder="Tempat Lahir">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Tanggal Lahir <span style="color: #FF0000;">*</span></label>
                                                <input type="text" class="form-control datepicker" id="Tanggal_Lahir" name="Tanggal_Lahir" placeholder="Tanggal Lahir dd/mm/YYYY">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- Username -->
                                            <div class="form-group">
                                                <label for="">Username <span style="color: #FF0000;">*</span></label>
                                                <input type="text" class="form-control only-lowercase" id="Username" name="Username" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- Email -->
                                            <div class="form-group">
                                                <label for="">Email <span style="color: #FF0000;">*</span></label>
                                                <input type="email" class="form-control" id="Email" name="Email" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Upload Foto -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="Upload Foto">Upload Foto</label>
                                                <input type="file" class="form-control uploads" id="Foto" name="Foto_Avatar" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="avatar">Foto</label>
                                                <br>
                                                <img class="product" id="avatar" width="250" height="200">          
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <div class="float-right">
                                        <button type="reset" class="btn btn-danger btn-sm"><strong>RESET</strong></button>
                                        <button type="submit" class="btn btn-success btn-sm"><strong>SUBMIT</strong></button>
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
        $(function(){
            $('.uploads').change(readURL)
            $('#f').submit(function(){
                // do ajax submit or just classic form submit
                //  alert("fake subminting")
                return false;
            });
        });

        // Jquery Validator
        $("#formPegawai").validate({
            // Rules
            rules: {
                Nama_Depan: "required",
                Nama_Belakang: "required",
                Jenis_Kelamin: "required",
                Agama: "required",
                Role: "required",
                Tempat_Lahir: "required",
                Tanggal_Lahir: "required",
                Alamat: "required",
                NIP: "required",
                Jurusan: "required",
                Username: "required",
                Email: {
                    required: true,
                    email: true
                },
            },
            // Specify validation error messages
            messages: {
                Nama_Depan: "Tolong masukkan Nama Depan",
                Nama_Belakang: "Tolong masukkan Nama Belakang",
                Jenis_Kelamin: "Tolong pilih jenis kelamin",
                Agama: "Tolong pilih agama (kecuali kalo ateis)",
                Role: "Tolong pilih role",
                Tempat_Lahir: "Tolong masukkan tempat lahir",
                Tanggal_Lahir: "Tolong masukkan tanggal lahir",
                Alamat: "Tolong masukkan alamat",
                NIP: "Tolong masukkan NIP",
                Jurusan: "Tolong masukkan jurusan",
                Username: "Tolong masukkan username",
                Email: "Tolong masukkan email",
            },
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

    </script>

@endpush
