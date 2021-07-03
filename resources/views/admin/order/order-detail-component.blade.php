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
                        <div class="col-md-6"> 654654846541</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Nama Pemilik</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> Mr. Lorem</div>
                    </div>
                    {{--  Divider --}}
                    <hr style="padding-top: 50px;">
                    <div class="row">
                        <div class="col-md-4">Nama dokumen      </div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> blablabla.docx</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Banyak Copy</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> 1 x</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Jumlah Halaman</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> 20 Halaman</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Jenis Kertas</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> A4</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Jenis Print</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6"> Print</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Deskripsi </div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-6">Hitam putih 18 Halaman Berwarna 2 Halaman</div>
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
            $('#harga').html("Rp. "+Number(500000).toLocaleString('id'));
        });
        
    </script>
@endpush