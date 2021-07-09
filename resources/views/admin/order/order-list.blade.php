<x-admin-layout>

    @push('stylesheet')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_page/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }} ">

    @endpush
    <section class="content-header">
        <h1>
            Order List
        </h1>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="data-table">
                                <thead>
                                    <th> No </th>
                                    <th> Customer </th>
                                    <th> File </th>
                                    <th> Jenis Print  </th>
                                    <th> Jumlah Halaman </th>
                                    <th> Banyak Copy </th>
                                    <th> Jenis Kertas </th>
                                    <th> Jilid </th>
                                    <th> Deskripsi </th>
                                    <th> Total Harga </th>
                                    <th> Status </th>
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
        function download(params) {
                console.log(params);
                $.get(url, function( data ) {
                    return;
                });
            }
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('order.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id'},
                    {data: 'customer.name', name: 'customer.name'},
                    {data: 'file', name: 'file'},
                    {data: 'print_type.name', name: 'print_type.name'},
                    {data: 'total_page', name: 'total_page'},
                    {data: 'total_copy', name: 'total_copy'},
                    {data: 'paper_type.name', name: 'paper_type.name'},
                    {data: 'jilid', name: 'jilid'},
                    {data: 'description', name: 'description'},
                    {data: 'total_price', name: 'total_price'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
    @endpush
</x-app-layout>
