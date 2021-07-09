@push('stylesheet')
    <style>
        .rectagle {
            /* position: absolute; */
            width: 100%;
            /* height: 700px; */
            /* left: 300px;
            top: 85px; */

            background: #FFFFFF;
            border: 3px solid #45A1FF;
            box-sizing: border-box;
            border-radius: 17px;
        }
    </style>
@endpush
        <div class="rectagle">
            <div class="container-fluid" style="font-size: 18px;">
                <p class="h3 text-center">Rician Pesanan</p>
                <hr>
                    <div class="row">
                        <div class="col-md-4">ID Pesanan</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> {{$order->id}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Nama Pemilik</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> {{$order->customer()->get()[0]->name}}</div>
                    </div>
                    {{--  Divider --}}
                    <hr style="padding-top: 50px;">
                    <div class="row">
                        <div class="col-md-4">Nama dokumen      </div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> {{$order->file}} | <a href="{{route('order.get.file', $order->file )}}" class="btn btn-success btn-xs"> Download </a></div>
                        <div class=""></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Banyak Copy</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> {{$order->total_copy}} x</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Jumlah Halaman</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> {{$order->total_page}} Halaman</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Jenis Kertas</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> {{$order->print_type()->get()[0]->name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Jenis Print</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> {{$order->paper_type()->get()[0]->name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Deskripsi </div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6">{{$order->description}}</div>
                    </div>
                    <hr style="padding-top: 50px;">
                <div class="row" style="padding-top: 70px;padding-bottom: 70px;">
                    <div class="col-md-4">Estimasi Harga</div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-6" id="harga">Rp. 0</div>
                </div>
            </div>
        </div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#harga').html("Rp. "+Number('{{$order->total_price}}').toLocaleString('id'));
        });
        
    </script>
@endpush