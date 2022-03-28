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
            </h2>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header" style="width: 100%">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link {{ setActive('aset') }}" href="{{ url('/aset') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ setActive('/aset/data/masuk') }}" href="{{ url('/aset/data/masuk') }}">Data Aset Masuk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ setActive('pembelian') }}" href="{{ url('/pembelian') }}">Pengecekan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <table class="table datatable">
                                <thead>
                                    <tr></tr>
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
