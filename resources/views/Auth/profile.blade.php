@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ Auth::user()->username }}!</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            @if(Auth::user()->avatar === '')
                                <img alt="image" id="avatar" src="https://ui-avatars.com/api/?name={{ Auth::user()->username }}&background=DFE9FD&color=7C8EFC" class="rounded-circle profile-widget-picture" style="width: 100px; height: 100px;">
                            @else 
                                <img alt="image" id="avatar" src="{{ asset('assets/img/foto-user/' . Auth::user()->avatar) }}" class="rounded-circle profile-widget-picture" style="width: 100px; height: 200px;">
                            @endif 
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ Auth::user()->username }} 
                                @if(Auth::user()->role_id === 1)
                                    <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> Super Admin</div>
                                @elseif(Auth::user()->role_id === 2)
                                    <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> TU Sarpras</div>
                                @else 
                                    <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> Kepala Sekolah</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="POST" action="{{ url('/user/' . $user->id . '/profile') }}" enctype="multipart/form-data" class="needs-validation" novalidate="">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                    
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="Username" value="{{ $user->username }}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the first name
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="Email" value="{{ $user->email }}" required="" readonly>
                                        <div class="invalid-feedback">
                                            Please fill in the last name
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" oninput="check()" class="form-control form-control-lg" id="Password" name="Password">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Retype - Password</label>
                                            <input type="password" oninput="check()" class="form-control form-control-lg" id="Retype_Password" name="Retype_Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="">Upload Foto</label>
                                        <input type="file" class="form-control uploads" id="Foto_Avatar" name="Foto_Avatar">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
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
        });

        function check()
        {
            if($('#Password').val() == $('#Retype_Password').val())
                $('#Submit').attr('disabled', false);
            else 
                $('#Submit').attr('disabled', true);
        }

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

        @if(session('message'))
            setTimeout(function() {
                $.bootstrapGrowl("{{ session('message') }}", 
                { 
                    type: 'success',
                    width: '300px;', 
                });
            }, 1000);
        @endif

    </script>

@endpush