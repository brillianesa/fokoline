<x-admin-layout>

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
            Upload Bukti Pembayaran
        </h1>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">

                        <div class="col-md-12">
                            <div class="alert alert-warning alert-dismissible">
                                <h4><i class="icon fa fa-info-circle"></i> Perhatian!</h4>
                                Mohon Lakukan Pembayaran 50% ( Rp. {{ number_format($order->total_price / 2) }}) dari Estimasi Harga
                            </div>
                        </div>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form class="row form-horizontal" style="margin-top:50px;" method="post" action="{{route('order.payment.action',$order->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">File</label>

                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="img">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px;"> Upload </button>
                                        <a href="{{ route('order.list') }}" class="btn btn-danger pull-right"> Batalkan </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                @include('admin.order.order-detail-component')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    @endpush
</x-app-layout>
