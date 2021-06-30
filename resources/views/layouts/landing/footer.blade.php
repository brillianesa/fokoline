
<!-- ***** Footer Start ***** -->
<footer style="background-color: #007bf7">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12">
                <p class="copyright text-light">Copyright &copy; 2020 Art Factory Company

            . Design: <a rel="nofollow" style="color: black;" href="https://templatemo.com">TemplateMo</a></p>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12">
                <ul class="social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="{{ asset('landing_page/js/jquery-2.1.0.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('landing_page/js/popper.js') }}"></script>
<script src="{{ asset('landing_page/js/bootstrap.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('landing_page/js/owl-carousel.js') }}"></script>
<script src="{{ asset('landing_page/js/scrollreveal.min.js') }}"></script>
<script src="{{ asset('landing_page/js/waypoints.min.js') }}"></script>
<script src="{{ asset('landing_page/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('landing_page/js/imgfix.min.js') }}"></script>

<!-- Global Init -->
<script src="{{ asset('landing_page/js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script>
    const BASE_URL = '{{ url('/') }}';
    const LOADER_IMG = "{{ asset('assets/icon/loader.gif') }}";

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        localStorage.setItem('latitude', position.coords.latitude);
        localStorage.setItem('longitude', position.coords.longitude);
    }
</script>
