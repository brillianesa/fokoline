<x-admin-layout>

    @push('stylesheet')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_page/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }} ">

    @endpush
    <section class="content-header">
        <h1>
            Pengaturan Harga
        </h1>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">

                        <div class="col-md-12">
                            <div class="col-md-12">
                                <h4> List Harga Jenis Print</h4>
                                <a href="{{ route('price.create') }}?type=print_type" class="btn btn-primary pull-right" style="margin-bottom: 20px;"> Tambah </a>
                            </div>

                            <div class="col-md-12">
                                <table class="table table-bordered" id="data-table-print-type">
                                    <thead>
                                        <th> No </th>
                                        <th> Vendor </th>
                                        <th> Nama </th>
                                        <th> Harga  </th>
                                        <th> Jenis  </th>
                                        <th width="200"> Action </th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <div class="col-md-12">
                                <h4> List Harga Kertas</h4>
                                <a href="{{ route('price.create') }}?type=paper" class="btn btn-primary pull-right" style="margin-bottom: 20px;"> Tambah </a>
                            </div>

                            <div class="col-md-12">
                                <table class="table table-bordered" id="data-table-paper">
                                    <thead>
                                        <th> No </th>
                                        <th> Vendor </th>
                                        <th> Nama </th>
                                        <th> Harga  </th>
                                        <th> Jenis  </th>
                                        <th width="200"> Action </th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <div class="col-md-12">
                                <h4> Harga Jilid </h4>
                                <a href="{{ route('price.create') }}?type=jilid" class="btn btn-primary pull-right" style="margin-bottom: 20px;"> Tambah </a>
                            </div>

                            <div class="col-md-12">
                                <table class="table table-bordered" id="data-table-jilid">
                                    <thead>
                                        <th> No </th>
                                        <th> Vendor </th>
                                        <th> Nama </th>
                                        <th> Harga  </th>
                                        <th> Jenis  </th>
                                        <th width="200"> Action </th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <!-- DataTables -->
    <script src="{{ asset('admin_page/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_page/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            generateTable('data-table-print-type', 'print_type');
            generateTable('data-table-paper', 'paper');
            generateTable('data-table-jilid', 'jilid');

            function generateTable(target, type) {
                var table = $('#' + target).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('price.index') }}",
                        data: function ( d ) {
                            d.type = type;
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'},
                        {data: 'store.name', name: 'store.name'},
                        {data: 'name', name: 'name'},
                        {data: 'price', name: 'price'},
                        {data: 'type_alias', name: 'type_alias'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
