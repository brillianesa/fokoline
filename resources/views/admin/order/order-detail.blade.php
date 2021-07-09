<x-admin-layout>
    @if(Session::has('download.in.the.next.request'))
        <meta http-equiv="refresh" content="1;url={{ Session::get('download.in.the.next.request') }}">
    @endif
    @push('stylesheet')
        <link rel="stylesheet" href="{{ asset('admin_page/bower_components/select2/dist/css/select2.min.css') }}">
        <style>
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                color: #444;
                line-height: 23px !important;
            }

            .bold {
                font-weight: bold
            }
        </style>
    @endpush

    <section class="content-header">
        <h1>
            Rincian Order
        </h1>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        @include('admin.order.order-detail-component')
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> History Order </h3>
                    </div>
                    <div class="box-body">
                        <ul class="timeline">
                            @foreach ($orderHistory as $key => $value)

                                {{-- const MENUNGGU_PEMBAYARAN = 'MENUNGGU PEMBAYARAN';
                                const VERIFIKASI_PEMBAYARAN = 'VERIFIKASI PEMBAYARAN';
                                const PESANAN_DIPROSES = 'PESANAN DIPROSES';
                                const PESANAN_DAPAT_DIAMBIL = 'PESAN DAPAT DIAMBIL';
                                const PESANAN_SELESAI = 'PESAN SELESAI'; --}}

                                @php
                                    $color = '';

                                    switch ($value->status) {
                                        case Order::MENUNGGU_PEMBAYARAN:
                                            $color = 'red';
                                            break;
                                        case Order::VERIFIKASI_PEMBAYARAN:
                                            $color = 'orange';
                                            break;
                                        case Order::PESANAN_DIPROSES:
                                            $color = 'blue';
                                            break;
                                        case Order::PESANAN_DAPAT_DIAMBIL:
                                            $color = 'maroon';
                                            break;
                                        case Order::PESANAN_SELESAI:
                                            $color = 'green';
                                            break;
                                        case Order::PESANAN_DITOLAK:
                                            $color = 'red';
                                            break;
                                    }
                                @endphp
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-{{ $color }}">
                                        {{ date_format($value->created_at, 'd-m-Y') }}
                                    </span>
                                </li>
                                <!-- /.timeline-label -->

                                <!-- timeline item -->
                                <li>
                                    <!-- timeline icon -->
                                    <i class="fa fa-envelope bg-{{ $color }}"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> {{ date_format($value->created_at, 'H:i') }}</span>

                                        <h3 class="timeline-header"><a href="#">{{ $value->status }}</a></h3>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    @endpush
</x-app-layout>
