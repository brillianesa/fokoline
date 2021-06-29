<x-admin-layout>

    @push('stylesheet')
    <style>
        .google-maps-link {
            display: none;
        }
        .float-right {
            float: right;
        }
    </style>
    @endpush

    <section class="content-header">
        <h1>
            Persetujuan Vendor
        </h1>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for=""> User </label>
                                <input type="text" value="{{ $store->user->name }}" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for=""> Email </label>
                                <input type="text" value="{{ $store->user->email }}" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-12">
                                <img src="{{ asset('admin_page/img/avatar.png') }}" class="img-responsive img-centered" style="display: block;margin: 0 auto;" height="300" width="300" alt="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""> Nama Vendor </label>
                                <input type="text" value="{{ $store->name }}" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for=""> Bank </label>
                                <input type="text" value="{{ $store->name }}" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for=""> No Rekening </label>
                                <input type="text" value="{{ $store->rekening_number }}" class="form-control" readonly>
                            </div>

                            <div class="form-group col-md-12">
                                <label for=""> Alamat </label>
                                <textarea name="" id="" cols="30" rows="10" readonly class="form-control">{{ $store->address }}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label for=""> Lokasi Maps </label>
                                <iframe
                                    class="col-md-12"
                                    width="300"
                                    height="170"
                                    frameborder="0"
                                    scrolling="no"
                                    marginheight="0"
                                    marginwidth="0"
                                    src="https://maps.google.com/maps?q={{ $store->latitude }},{{ $store->longitude }}&hl=es&z=14&amp;output=embed">
                                </iframe>
                                <br/>
                                <small>
                                <a
                                    href="https://maps.google.com/maps?q={{ $store->latitude }},{{ $store->longitude }}&hl=es;z=14&amp;output=embed"
                                    style="color:#0000FF;text-align:left"
                                    target="_blank">
                                    Lihat Lebih Detail
                                </a>
                                </small>
                            </div>

                            <div class="form-group col-md-12">
                                <a href="{{ route('store.approval.action', [
                                    'id' => $store->id,
                                    'action' => 'accept'
                                ]) }}" class="btn btn-primary float-right" style="margin-left: 5px"> Terima </a>

                                <a href="{{ route('store.approval.action', [
                                    'id' => $store->id,
                                    'action' => 'reject'
                                ]) }}" class="btn btn-danger float-right" style="margin-left: 5px"> Tolak </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    @endpush
</x-app-layout>
