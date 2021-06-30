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
                    <input id="search-vendor" class="form-control" type="text" placeholder="Fotokopi ..."/>
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
   var activeInfoWindow;
   var icon = "{!! asset('icons/marker.svg') !!}";
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -6.373643041124395, lng: 106.784204331353 },
            zoom: 15,
            mapTypeControl: false,
        });
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                curloc = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                infoWindow.setPosition(curloc);
                infoWindow.setContent("Posisi Saat Ini");
                infoWindow.open(map);
                map.setCenter(curloc);
            }, () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
        infoWindow = new google.maps.InfoWindow();

        const locationButton = document.createElement("button");
        locationButton.textContent = "Lokasi Saat Ini";
        locationButton.classList.add("custom-map-control-button");
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

        $vendors = {!! json_encode($vendors->toArray()) !!};
        $vendors.forEach(e => {
            pos = new google.maps.LatLng(e.latitude, e.longitude);
            marks(pos, e.name, e.image, e.id);
        });
        function marks(location, name, image, id) {
            var info = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                position: location,
                map,
                icon: icon,
                title : name
            });

            marker.addListener("click", () => {
                //Info Distance
                var distance = String(CalcDist(curloc, location).toFixed(2))+" KM";
                //URL image
                var storeImage = "{!! asset('storeimages/"+image+"') !!}";
                var urlStore = "{{ route('store-detail', ":id") }}";
                urlStore = urlStore.replace(':id', id);
                console.log(id);

                //Content Info window for marker
                var contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                "</div>" +
                '<h1 id="firstHeading" class="firstHeading">'+name+'</h1>' +
                '<div id="bodyContent">' +
                "<p><b>"+name+"</b>, Berjarak sekitar <b>"+distance+"</b> dari posisi kamu sekarang.</p>" +
                ''+
                '<img style="height: 100px; width: 200px;" src="'+storeImage+'" alt="'+image+'">' +
                "<p class='mb-2 mt-2'>Kunjungi toko, <a href='"+urlStore+"' class='btn btn-info btn-sm' >Kunjungi</a></p>" +
                "</div>" +
                "</div>";


                info.setPosition(location);
                info.setContent(contentString);
                if(activeInfoWindow != null) activeInfoWindow.close();
                info.open({
                    anchor: marker,
                    map
                });
                map.setZoom(15);
                map.panTo(marker.getPosition());
                activeInfoWindow = info;
            });
        }


        //Distance
        function CalcDist(mk1, mk2) {
            R = 6371.0710; // Radius of the Earth in Kilos
            rlat1 = mk1.lat() * (Math.PI/180); // Convert degrees to radians
            rlat2 = mk2.lat() * (Math.PI/180); // Convert degrees to radians
            difflat = rlat2-rlat1; // Radian difference (latitudes)
            difflon = (mk2.lng()-mk1.lng()) * (Math.PI/180); // Radian difference (longitudes)

            d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
            return d;
        }

        google.maps.event.addListener(map, 'click', function(event) {
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
