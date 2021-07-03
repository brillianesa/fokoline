@php
    $price = $price ?? null;
    $page = $price ? 'Edit' : 'Tambah';
    $action = $price ? route('price.update', $price->id) : route('price.store');
@endphp

<x-admin-layout>
    @push('stylesheet')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin_page/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }} ">

    @endpush
    <section class="content-header">
        <h1>
            {{ $page }} Harga {{ $alias }}
        </h1>
    </section>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">

                        <div class="col-md-12">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        </div>

                        <form action="{{ $action }}" class="col-md-12" method="post">

                            @csrf

                            <input type="hidden" name="store_id" value="{{ $store->id }}">
                            <input type="hidden" name="type" value="{{ $type }}">

                            @if ($price)
                                <input type="hidden" name="_method" value="PUT">
                            @endif

                            <div class="form-group">
                                <label for=""> Nama </label>
                                <input type="text" name="name" class="form-control" value="{{ $price->name ?? old('name')}}">
                            </div>

                            <div class="form-group">
                                <label for=""> Harga </label>
                                <input type="number" name="price" class="form-control" value="{{ $price->price ?? old('price')}}">
                            </div>


                            <div class="form-group pull-right">
                                <a href="{{ route('price.index') }}"class="btn btn-danger"> Batal </a>
                                <button type="submit" class="btn btn-success"> Simpan </button>
                             </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')

    @endpush
</x-app-layout>
