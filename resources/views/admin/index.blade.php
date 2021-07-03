<x-admin-layout>
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>

    <section class="content container-fluid">
        <div class="row">

            <div class="col-md-6">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Order</span>
                        <span class="info-box-number">{{ $totalOrder }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box bg-blue">
                    <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Order Status Selesai</span>
                        <span class="info-box-number">{{ $totalOrderDone }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Jumlah Order Per Status</h3>
                    </div>

                    <div class="box-body no-padding">
                        <div id="chart-1"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Harga Order Per Status</h3>
                    </div>

                    <div class="box-body no-padding">
                        <div id="chart-2"></div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Jumlah Order Seminggu Terakhir</h3>
                    </div>

                    <div class="box-body no-padding">
                        <div id="chart-3"></div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    @push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        $(document).ready(function() {
            let orderPerStatus = @json($orderPerStatus);

            let orderAmountData = [],
                orderTotalData = [];

            orderPerStatus.map((value, key) => {
                orderAmountData.push({
                    name: value.status,
                    y: value.count,
                });

                orderTotalData.push({
                    name: value.status,
                    y: value.total_price
                })
            });

              Highcharts.setOptions({
                global: {
                    useUTC: false,
                },
                lang: {
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });

            Highcharts.chart('chart-1', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: ''
                },
                tooltip: {
                    pointFormat: 'Total: <b>{point.y:,.0f}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                    name: 'Jumlah Order Per Status',
                    colorByPoint: true,
                    data: orderAmountData
                }]
            });

            Highcharts.chart('chart-2', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: ''
                },
                tooltip: {
                    pointFormat: 'Total: <b>{point.y:,.0f}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.0f} %'
                        }
                    }
                },
                series: [{
                    name: 'Harga Order Per Status',
                    colorByPoint: true,
                    data: orderTotalData
                }]
            });
        });
    </script>
    @endpush
</x-app-layout>
