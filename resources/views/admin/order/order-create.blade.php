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
                                    <th> Status </th>
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
        </div>
    </section>
</x-app-layout>
