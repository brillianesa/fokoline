<x-app-layout>
    @push('stylesheet')
    <style>
        p {
            color: white !important;
        }

        h5 {
            color: white !important;
        }
    </style>
    @endpush
    <section class="section mt-5" id="about" style="background: #45A1FF; color: white !important">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s" data-scroll-reveal-id="3" data-scroll-reveal-initialized="true" data-scroll-reveal-complete="true">
                    <img src="{{ asset('landing_page/images/left-image.png') }}" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="right-text col-lg-5 col-md-12 col-sm-12 mobile-top-fix">
                    <div class="left-heading">
                        <h5>Fokoline</h5>
                    </div>
                    <div class="left-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus consectetur dolorem rerum modi sapiente ratione possimus, voluptates ab facilis consequuntur odit quae? Provident sit ipsa nisi doloribus nam eos et?</p>
                        {{-- <a href="#about2" class="main-button">Discover More</a> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
