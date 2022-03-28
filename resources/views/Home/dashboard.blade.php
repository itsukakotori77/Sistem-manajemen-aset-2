@extends('layouts.app')

@push('custom-css')

    <link rel="stylesheet" href="{{ asset('assets/module/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/module/chart.js/dist/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/module/summernote/dist/summernote-bs4.css') }}">

@endpush 

@section('content')

    <section class="section">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="balance-chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pemeliharaan</h4>
                        </div>
                        <div class="card-body">{{ $data['pemeliharaan'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-chart">
                        <canvas id="sales-chart" height="80"></canvas>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Penyusutan</h4>
                        </div>
                        <div class="card-body">{{ $data['penyusutan'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Budget vs Sales</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection 

@push('custom-script')

    <script src="{{ asset('assets/module/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/module/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/module/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/module/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/module/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/module/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/module/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <script>
        var tanggal = [];
        for(i=0;i<=30;i++)
        {
            var first = moment().startOf('month').format('MM/DD/YYYY');
            tanggal[i] = moment(first).add(i, 'days').format('MM/DD/YYYY');
        }

        var tanggal_baru = [];
        for(i=0;i<=30;i++)
        {
            var first = moment().startOf('month').format('MM/DD/YYYY');
            tanggal_baru[i] = moment(first).add(i, 'days').format('MM/DD/YYYY');
        }

        // Penyusutan
        var data_penyusutan = [
            @foreach($data['data_penyusutan'] as $penyusutan)
                {{ $penyusutan }},
            @endforeach
        ];

        // Pemeliharaan
        var data_pemeliharaan = [
            @foreach($data['data_pemeliharaan'] as $pemeliharaan)
                {{ $pemeliharaan }},
            @endforeach
        ];
        
        // Pengajuan diterima 
        var pengajuan_diterima = [
            @foreach($data['pengajuan_diterima'] as $diterima)
                {{ $diterima }},
            @endforeach
        ];

        // Pengajuan diterima 
        var pengajuan_ditolak = [
            @foreach($data['pengajuan_ditolak'] as $ditolak)
                {{ $ditolak }},
            @endforeach
        ];

        // Main Chart
        var ctx = document.getElementById("myChart").getContext('2d');

        // Setting Balance Main
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: tanggal_baru,
                datasets: [{
                label: 'Pengajuan Diterima',
                    data: pengajuan_diterima,
                    borderWidth: 2,
                    backgroundColor: 'rgba(63,82,227,.8)',
                    borderWidth: 0,
                    borderColor: 'transparent',
                    pointBorderWidth: 0,
                    pointRadius: 3.5,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                },
                {
                label: 'Pengajuan Ditolak',
                    data: pengajuan_ditolak,
                    borderWidth: 2,
                    backgroundColor: 'rgba(254,86,83,.7)',
                    borderWidth: 0,
                    borderColor: 'transparent',
                    pointBorderWidth: 0 ,
                    pointRadius: 3.5,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                }]
            },
            options: {
                legend: {
                display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                        // display: false,
                        drawBorder: false,
                        color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1500,
                            callback: function(value, index, values) {
                                return value;
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            tickMarkLength: 15,
                        }
                    }]
                },
            }
        });

        // Pemeliharaan
        var balance_chart = document.getElementById("balance-chart").getContext('2d');
        var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
        balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
        balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

        // pemelihaan
        var myChart = new Chart(balance_chart, {
            type: 'line',
            data: {
                labels: tanggal,
                datasets: [{
                    label: 'Balance',
                    data: data_pemeliharaan,
                    backgroundColor: balance_chart_bg_color,
                    borderWidth: 3,
                    borderColor: 'rgba(63,82,227,1)',
                    pointBorderWidth: 0,
                    pointBorderColor: 'transparent',
                    pointRadius: 3,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                }]
            },
            options: {
                layout: {
                    padding: {
                        bottom: -1,
                        left: -1
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        beginAtZero: true,
                        display: false
                    }
                }],
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        display: false,
                    },
                    ticks: {
                        display: false
                    }
                }]
                },
            }
        });

        // Penyusutan
        var sales_chart = document.getElementById("sales-chart").getContext('2d');
        var sales_chart_bg_color = sales_chart.createLinearGradient(0, 0, 0, 80);
        balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
        balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

        // Setting Sales Chart
        var myChart = new Chart(sales_chart, {
            type: 'line',
            data: {
                labels: tanggal,
                datasets: [{
                    label: 'Sales',
                    data: data_penyusutan,
                    borderWidth: 2,
                    backgroundColor: balance_chart_bg_color,
                    borderWidth: 3,
                    borderColor: 'rgba(63,82,227,1)',
                    pointBorderWidth: 0,
                    pointBorderColor: 'transparent',
                    pointRadius: 3,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                }]
            },
            options: {
                layout: {
                    padding: {
                        bottom: -1,
                        left: -1
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                yAxes: [{
                    gridLines: {
                    display: false,
                    drawBorder: false,
                    },
                    ticks: {
                    beginAtZero: true,
                    display: false
                    }
                }],
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        display: false,
                    },
                    ticks: {
                        display: false
                    }
                }]
                },
            }
        });

    </script>

@endpush 