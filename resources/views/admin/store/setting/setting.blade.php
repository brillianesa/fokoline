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
                            <a href="{{ route('price.create') }}" class="btn btn-primary pull-right" style="margin-bottom: 20px;"> Tambah </a>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-bordered" id="data-table">
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
    </section>

    @push('scripts')
    <!-- DataTables -->
    <script src="{{ asset('admin_page/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_page/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('price.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id'},
                    {data: 'store.name', name: 'store.name'},
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'type_alias', name: 'type_alias'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
    @endpush
</x-app-layout>
