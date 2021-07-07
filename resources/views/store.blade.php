<x-app-layout>
    <section class="section mt-5" id="about" style="background: #45A1FF;">
        <div class="container">
            <div class="row">
                @foreach ($vendors as $key => $value)
                    <div class="owl-item cloned col-md-4">
                        <div class="item service-item">
                            <div class="icon">
                                <i><img src="assets/images/service-icon-02.png" alt=""></i>
                            </div>
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
