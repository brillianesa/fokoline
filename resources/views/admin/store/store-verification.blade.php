<x-admin-layout>

    @push('stylesheet')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_page/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }} ">

    @endpush

    <section class="content-header">
        <h1>
            Verifikasi Vendor
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
                                    <th> User </th>
                                    <th> Nama Vendor </th>
                                    <th> Alamat </th>
                                    <th width="50"> Action </th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
                ajax: "{{ route('store.verification') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'address'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
    @endpush
</x-app-layout>
