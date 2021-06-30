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
            Buat Order
        </h1>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <form class="row form-horizontal" style="margin-top:50px;" method="post" action="" enctype="multipart/form-data">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">File</label>

                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jenis Print</label>

                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="print_type" data-placeholder="Pilih Jenis Print">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jumlah Halaman</label>

                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="total_page">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Banyak Copy</label>

                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="total_copy">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jenis Kertas</label>

                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="paper_type" data-placeholder="Pilih Jenis Kertas">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Deskripsi</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px;"> Order </button>
                                        <button type="submit" class="btn btn-danger pull-right"> Cancel </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5" style="border: 2px solid black; background: rgba(255, 251, 251, 0.582)">
                                <h2 class="text-center"> Rincian Vendor </h2>
                                <hr>

                                <div class="form-group">
                                    <img src="{{ asset('admin_page/img/avatar.png') }}" class="img-responsive img-centered" style="display: block;margin: 0 auto;" height="300" width="300" alt="">
                                </div>

                                <div class="col-md-12 no-padding">
                                    <h4 class="bold"> {{ $store->name }} </h4>
                                    <p>{{ $store->address }}</p>
                                    <p> Pembayaran </p>
                                    <ul>
                                        <li> Ovo : 078212307213781 </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{ asset('admin_page/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2({width: '100%'});
            })
        </script>
    @endpush
</x-app-layout>
