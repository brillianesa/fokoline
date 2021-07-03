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
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form class="row form-horizontal" style="margin-top:50px;" method="post" action="{{route('order.create.action',$order->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">File</label>

                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="file">
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
