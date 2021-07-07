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
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form class="row form-horizontal" style="margin-top:50px;" method="post" action="{{route('order.create.action',$store->id)}}" enctype="multipart/form-data">
                            @csrf
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
                                        <select class="form-control select2" name="print_type" id="print_type" data-placeholder="Pilih Jenis Print">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jumlah Halaman</label>

                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="total_page" id="total_page">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Banyak Copy</label>

                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="total_copy" id="total_copy">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jenis Kertas</label>

                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="paper_type" id="paper_type" data-placeholder="Pilih Jenis Kertas">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jilid</label>
                                    <div class="col-sm-10">
                                        <input class="form-check-input position-static" type="checkbox" value="true" id="jilid" name="jilid">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Deskripsi</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" name="description"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="hidden" name="total_price" id="total_price_value">
                                        <p><h4>Total yang harus dibayar : </h4> <h3 id="total_prices">Rp. 0</h3> </p>
                                        <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px;"> Order </button>
                                        <button type="submit" class="btn btn-danger pull-right"> Cancel </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5" style="border: 2px solid black; background: rgba(255, 251, 251, 0.582)">
                                <h2 class="text-center"> Rincian Vendor </h2>
                                <hr>

                                <div class="form-group">
                                    <img src="{{ asset('storeimages/' . $store->image) }}" class="img-responsive img-centered" style="display: block;margin: 0 auto;" height="300" width="300" alt="">
                                </div>

                                <div class="col-md-12 no-padding">
                                    <h4 class="bold"> {{ $store->name }} </h4>

                                    <p>{{ $store->address }}</p>
                                    @php
                                        $list_pembayaran = json_decode($store->payment_list) ?? [];
                                    @endphp

                                    <p for=""> Metode Pembayaran </p>
                                    <ul>
                                        @foreach ($list_pembayaran as $key => $value)
                                            <li> {{ $value }} </li>
                                        @endforeach
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
                let prices = @json($store->prices()->get());
                let jilidPrice = @json($jilidprice->price);
                let select1 = $('#print_type');
                let select2 = $('#paper_type');
                let totalPrice ;
                let pricePrintType;
                let pricePaperType;

                var dataPrintType = prices.map((v) => {
                    if (v.type == 'print_type') {
                        return {
                            id: v.id,
                            text: v.name,
                            price: v.price
                        }
                    }
                });
                var dataPapers = prices.map((v) => {
                    if (v.type == 'paper') {
                        return {
                            id: v.id,
                            text: v.name,
                            price: v.price
                        }
                    }
                });

                select1.select2({
                    width: '100%',
                    data : dataPrintType,
                }).on('select2:select', (e) => {
                    pricePrintType = e.params.data.price;
                    console.log(pricePrintType);
                    count(pricePrintType, pricePaperType);
                    console.log('harga', totalPrice);
                });

                select2.select2({
                    width: '100%',
                    data : dataPapers
                }).on('select2:select', (e) => {
                    pricePaperType = e.params.data.price;
                    console.log(pricePaperType);
                    count(pricePrintType, pricePaperType);
                    console.log('harga', totalPrice);
                });

                $("#jilid").change(function() {
                    count(pricePrintType, pricePaperType)
                });

                var elementTotalPrice = $('#total_prices'),
                    elementTotalPriceInput = $('#total_price_value');

                function count(b1, b2) {
                    basePrice = (b1 && b2) ? b1+b2 : 0;
                    totalPrice = (basePrice * $('#total_page').val()) * $('#total_copy').val();

                    // jilid logic
                    if ($('#jilid').is(':checked')) {
                        jilidTotal = jilidPrice * $('#total_copy').val();
                        console.log('jilid' + jilidTotal);
                        totalPrice += jilidTotal;
                    }

                    elementTotalPrice.html(convertToRupiah(totalPrice));
                    elementTotalPriceInput.val(totalPrice);
                }

                $('input').on('change', ()=>{
                    count(pricePrintType, pricePaperType);
                })
            })

            function convertToRupiah(angka)
            {
                var rupiah = '';
                var angkarev = angka.toString().split('').reverse().join('');
                for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
                return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
            }
        </script>
    @endpush
</x-app-layout>
