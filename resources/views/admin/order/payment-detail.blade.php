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
            Rincian Bukti Pembayaran
        </h1>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form class="row form-horizontal" id="form-order-action" style="margin-top:50px;" method="post" action="{{route('order.payment.verify',$order->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Bukti Pembayaran :</label>

                                    <div class="col-sm-10">
                                        <img src="{{ asset('prooffiles/'.$order->payment_file) }}" alt="payment_file" style="width: 700px; height: 500px">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <a href="{{route('order.list')}}" class="btn btn-primary" style="margin-left: 5px;"> Kembali </a>
                                        <button type="submit" class="btn btn-success pull-right" style="margin-left: 5px;"> Proses Pesanan </button>
                                        <button type="submit" id="reject" class="btn btn-danger pull-right"> Tolak Pesanan </a>
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
        <script>
            $(document).ready(function() {
                var url = "{{route('order.payment.deny',$order->id)}}";
                $('button#reject').on('click', () => {
                    $('form#form-order-action').attr('action', url)
                });
            })
        </script>
    @endpush
</x-app-layout>
