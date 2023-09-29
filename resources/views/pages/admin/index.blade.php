@extends('layouts.server.main', ['sbActive' => 'dashboard'])
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Management Dashboard - Admin</h1>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                                Data Kategori
                            </div>
                            <div class="h5 mt-1 font-weight-bold text-gray-900">{{ $data['kategori'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-archive fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-indigo shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                                Data Karyawan
                            </div>
                            <div class="h5 mt-1 font-weight-bold text-gray-900">{{ $data['karyawan'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-indigo"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                                Data Customer
                            </div>
                            <div class="h5 mt-1 font-weight-bold text-gray-900">{{ $data['customer'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-800 text-uppercase">
                                Data Vespa
                            </div>
                            <div class="h5 mt-1 font-weight-bold text-gray-900">{{ $data['model_vespa'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-motorcycle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xl-8 col-lg-7">
            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray-800">Data Penjualan Terakhir</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="row justify-content-center">
                <div class="col-xl col-md">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                        Total Penjualan
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 0</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                        Sisa Stok
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['total_stock_vespa'] }} Unit</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-cubes fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                        Jumlah Pesanan
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">0 Order</div>
                                </div>
                                <div class="col-auto">
                                   <i class="fas fa-shopping-bag fa-2x text-gray-900"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/dashboard/vendor/chart.js/Chart.min.js') }}"></script>
    
    <!-- Page level custom scripts -->
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June"],
                datasets: [{
                label: "Total",
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                    data: [],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    },
                    maxBarThickness: 25,
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 15000,
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        // callback: function(value, index, values) {
                        //   return '$' + number_format(value);
                        // }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    // callbacks: {
                    //   label: function(tooltipItem, chart) {
                    //     var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    //     return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    //   }
                    // }
                },
            }
        });
    </script>
@endpush