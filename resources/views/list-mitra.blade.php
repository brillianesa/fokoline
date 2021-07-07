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
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    @endpush

    <section class="section" id="frequently-question" style="background: #45A1FF;">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2 class="text-light">List Mitra {{ env('APP_NAME') }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="card-group">
                    <?php 
                    foreach ($vendors as $store) {
                        
                    ?>
                        <div class="col-sm-4 mb-4">
                            <a href="{{route('order.create',$store->id)}}" class="text-dark">
                            
                                <div class="card">
                                <img class="card-img-top card-image" src="{{ asset('storeimages/'.$store->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{$store->name}}</h5>
                                    <p class="card-text text-dark">{{ $store->address }}</p>
                                </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    
    @endpush
</x-app-layout>
