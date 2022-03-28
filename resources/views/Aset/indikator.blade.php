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
                    <a href="{{ url('/aset/data/masuk') }}" class="btn btn-primary"><strong>KEMBALI</strong></a>
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
                        <div class="card-body">
                            <form action="{{ url('/pembelian/indikator') }}" method="POST" id="formAset" autocomplete="off" enctype="multipart/form-data">
                                <div class="container">
                                    <!-- Kondisi -->
                                    @if(session('message'))
                                        <div class="alert alert-primary" role="alert">
                                            <i class="fa fa-bell"></i>
                                            {{ session('message') }}
                                        </div>
                                    @endif

                                    <!-- Token -->
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}

                                    <!-- Nama -->
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="">Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <select name="Aset_ID" class="form-control" id="Aset_ID">
                                                    <option selected="selected" disabled>-- Pilih Aset --</option>
                                                    @foreach($data['aset'] as $aset)
                                                        <option value="{{ $aset->Kode_Aset }}">{{ $aset->Nama_Aset . ' (' . $aset->Nama_Ruangan . ')' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="">Kode Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" required class="form-control" maxlength="6" id="Kode" name="Kode" placeholder="Kode Aset">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="">Umur Ekonomis <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" required class="form-control only-number" id="Umur_Ergonomis" name="Umur_Ergonomis" placeholder="Umur Ekonomis">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Jumlah Aset -->
                                        <div class="col-sm-2">
                                            <label for="">Jumlah Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="number" min="1" required class="form-control only-number" oninput="total()"  id="Jumlah_Aset" name="Jumlah_Aset" placeholder="Jumlah Aset">
                                            </div>
                                        </div>
                                        <!-- Harga Aset -->
                                        <div class="col-sm-5">
                                            <label for="">Harga Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" required class="form-control only-number" oninput="total()" id="Harga_Aset" name="Harga_Aset" placeholder="Harga Aset">
                                            </div>
                                        </div>
                                        <!-- Kondisi Aset -->
                                        <div class="col-sm-5">
                                            <label for="">Total Harga <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <input type="text" required class="form-control only-number" oninput="total()" id="Total_Harga" name="Total_Harga" placeholder="Harga Aset">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Keterangan -->
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="Keterangan">Keterangan <span style="color: #FF0000;">*</span></label>
                                                <div class="form-line">
                                                    <textarea name="Keterangan" required class="form-control" id="Keterangan" cols="30" rows="5" placeholder="Keterangan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="">Sumber Aset <span style="color: #FF0000;">*</span></label>
                                            <div class="form-group">
                                                <select name="Sumber_Aset" id="Sumber_Aset" class="form-control">
                                                    <option selected="selected" disabled>-- Pilih Sumber --</option>
                                                    <option value="1">Sekolah</option>
                                                    <option value="2">Pemerintah</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="Upload Foto">Upload Foto</label>
                                                <input type="file" class="form-control uploads" id="Foto" name="Foto_Avatar" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- Upload Foto -->
                                            <div class="form-group">
                                                <label for="avatar">Foto</label>
                                                <br>
                                                <img class="product" id="avatar" width="200px" height="200px">          
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <div class="float-right">
                                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
        $("#formAset").validate({
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

        $('#Aset_ID').on('change', function() {
            // Ajax Data
            $.ajax({
                url : "{{ url('/pembelian') }}" + "/" + this.value + "/indikator",
                type : "GET",
                dataType : "JSON",
                success : function(data)
                {
                    // $.each(data,function(Data, value)
                    // {
                    //     $("#Desa").append('<option value="'+ value.nama +'">'+value.nama+'</option>');
                    // });
                    // alert(data);
                    $('#Jumlah_Aset').val(data.Jumlah_Aset);
                    $('#Harga_Aset').val(data.Harga_Aset);
                    $('#Total_Harga').val(data.Total_Harga);
                    $('#Keterangan').val(data.Keterangan);
                    $('#Sumber_Aset').val(data.Sumber_Aset);
                }
            });
        });

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