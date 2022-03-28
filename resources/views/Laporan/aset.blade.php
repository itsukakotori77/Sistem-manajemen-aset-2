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
                    <!-- <a href="{{ url('/perencanaan/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> <strong>TAMBAH</strong></a> -->
                    <form action="{{ url('/laporan/download/aset') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> <strong>DOWNLOAD</strong></button>
                    </form>
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
                            <canvas id="myChart" height="100px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection 

@push('custom-css')

    <link rel="stylesheet" href="{{ asset('assets/module/chart.js/dist/Chart.min.css') }}">

@endpush 

@push('custom-script')

    
    <script src="{{ asset('assets/module/chart.js/dist/Chart.min.js') }}"></script>
    <script>

        // Category
        var tanggal = [];
        for(i=0;i<=30;i++)
        {
            var first = moment().startOf('month').format('MM/DD/YYYY');
            tanggal[i] = moment(first).add(i, 'days').format('MM/DD/YYYY');
        }

        var data_aset = [
            @foreach($data['data_aset'] as $aset)
                {{ $aset }},
            @endforeach
        ];

        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: tanggal,
                datasets: [{
                label: 'Statistics',
                data: data_aset,
                    borderWidth: 2,
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                        },
                        ticks: {
                        beginAtZero: true,
                        stepSize: 150
                        }
                    }],
                    xAxes: [{
                        ticks: {
                        display: false
                        },
                        gridLines: {
                        display: false
                        }
                    }]
                },
            }
        });
    </script>

@endpush 