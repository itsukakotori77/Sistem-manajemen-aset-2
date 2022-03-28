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
                            <h4>{{ $data['title'] . ' ' . $data['aset']->Nama_Aset }}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Perolehan</th>
                                        <th>Masa Manfaat</th>
                                        <th>Harga Awal Aset</th>
                                        <th>Beban Penyusutan</th>
                                        <th>Harga Akhir Aset</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                    @foreach($data['penyusutan'] as $penyusutan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $penyusutan['Perolehan'] }}</td>
                                            <td>{{ $penyusutan['Masa_Manfaat'] . ' Tahun' }}</td>
                                            <td>{{ rupiah($penyusutan['Harga_Awal']) }}</td>
                                            <td>{{ rupiah($penyusutan['Penyusutan']) }}</td>
                                            <td>{{ rupiah($penyusutan['Harga_Akhir']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-sm-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik Penyusutan Aset {{ $data['aset']->Nama_Aset }}</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" width="455" height="227" class="chartjs-render-monitor" style="display: block; width: 455px; height: 227px;"></canvas>
                        </div>
                    </div>
                </div> -->
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
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [{
                label: 'Statistics',
                data: [460, 458, 330, 502, 430, 610, 488],
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