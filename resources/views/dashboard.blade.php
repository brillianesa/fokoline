<x-app-layout>
    @push('stylesheet')
    <style>
        .custom-map-control-button {
            background-color: #fff;
            border: 0;
            border-radius: 2px;
            box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
            margin: 10px;
            padding: 0 0.5em;
            font: 400 18px Roboto, Arial, sans-serif;
            overflow: hidden;
            height: 40px;
            cursor: pointer;
        }
        .custom-map-control-button:hover {
            background: #ebebeb;
        }
    </style>
    @endpush

    <section class="section" id="frequently-question">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Cari Tempat Fotokopi Terdekat</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="section-heading">
                        <select name="" class="form-control" id="">
                            <option value=""> asddaksdk </option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class="row mt-5">
                <div class="col-md-12" id="map" style="height: 500px; width: 1500px; border-radius: 5px" class="img-thumbail"></div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('API_KEY') }}&callback=runInit&libraries=places"type="text/javascript"></script>
    <script>

   let map, infoWindow;
   var icon = "{!! asset('icons/marker.svg') !!}";
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -6.371221577144296, lng: 106.76703995812765 },
            zoom: 17,
            mapTypeControl: false,
        });
        infoWindow = new google.maps.InfoWindow();

        const locationButton = document.createElement("button");
        locationButton.textContent = "Lokasi Saat Ini";
        locationButton.classList.add("custom-map-control-button");
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

        $vendors = {!! json_encode($vendors->toArray()) !!};
        $vendors.forEach(e => {
            new google.maps.Marker({
                position: new google.maps.LatLng(e.latitude, e.longitude),
                map,
                icon: icon,
                title : e.name
            });
        });

        locationButton.addEventListener("click", () => {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                infoWindow.setPosition(pos);
                infoWindow.setContent("Posisi Saat Ini");
                infoWindow.open(map);
                map.setCenter(pos);
                },
                () => {
                handleLocationError(true, infoWindow, map.getCenter());
                }
            );
            } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
            }
        });

        google.maps.event.addListener(map, 'click', function(event) {
            // placeMarkerIputM2(this, event.latLng);
            console.log(event.latLng.toJSON());
        });
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation."
        );
        infoWindow.open(map);
    }

    </script>
    <script>
        function runInit() {
                initMap();
                initAutocomplete();
            }
    </script>
    @endpush
</x-app-layout>
