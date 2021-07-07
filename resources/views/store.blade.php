<x-app-layout>
@push('stylesheet')
<style>
    .card-img-top {
        width: 100%;
        height: 15vw;
        object-fit: cover;
    }
    .card{
        border-radius: 4px;
        backface-visibility: none;
        box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
        transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
        cursor: pointer;
    }

    .card:hover{
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
    }

</style>
@endpush
    <section class="section mt-5" id="about" style="background: #45A1FF;">
        <div class="container">
            <div class="row">
                @foreach ($vendors as $key => $value)
                    <div class="owl-item cloned col-md-4 mb-4">
                        <div class="item service-item card">
                            <img class="card-img-top card-image" src="{{ asset('storeimages/'.$value->image) }}" alt="">
                            <h5 class="service-title">{{ $value->name }}</h5>
                            <p>{{ substr($value->address, 0, 50) }} ...</p>
                            <a href="{{ route('order.create', ['id' => $value->id]) }}" class="main-button">Order</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
