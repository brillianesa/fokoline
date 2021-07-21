<x-app-layout>
    @push('stylesheet')
    <style>
        .custom-map-control-button {
            margin-top: 10px;
            display: inline-block;
            margin-bottom: 0;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            border-radius: 4px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            color: #fff;
            background-color: #45A1FF;
            border-color: #65b2ff;
        }
        .custom-map-control-button:hover {
            background: #0080ff;
        }

        .store-near {
            padding: 5px;
        }

        .store-near:hover {
            background: #d9dbdd;
            cursor: pointer;
            border-radius: 10px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    <section class="section" id="frequently-question" style="background: #45A1FF;">
        <div class="container">
            <!-- ***** Section Title Start ***** -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2 class="text-light">Cari Tempat Fotokopi Terdekat</h2>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input id="search-vendor" class="form-control" type="text" placeholder="Fotokopi ..."/>
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                          </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>

        <div class="map-with-table">
            <div class="row">
                <div class="col-md-8 mt-4" id="map" style="height: 590px; width: 1500px; border-radius: 25px; border: 3px; border-color: gray; border-style: solid;" class="img-thumbail"></div>
                {{-- <div class="col-md-"></div> --}}
                <div class="col-md-4 mt-4" style="">
                    <div class="col-md-12" style="background: white; border-radius: 25px; border: 3px; border-color: gray; border-style: solid;">
                        <h4 class="mt-2 text-center"> Fotokopi Terdekat </h4>
                        <ul class="mt-2 mb-3" id="nearby-vendor">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('API_KEY') }}&callback=runInit&libraries=places"type="text/javascript"></script>
    <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
    <script>

    let map, infoWindow;
    var activeInfoWindow;
    var markers = [];
    var icon = "{!! asset('icons/marker.svg') !!}";

    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
    };

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

                initVendorNear(position.coords.latitude, position.coords.longitude);
            }, () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            , options) ;
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
        infoWindow = new google.maps.InfoWindow();

        // Create the search box.
        let vendorS = $('#search-vendor');
        var path = "{{ route('store-autocomplete') }}";
        vendorS.autocomplete({
            source: (query, res) => {
                $.ajax({
                    url: path,
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        search: query.term
                    },
                    success: function( data ) {
                        res(data);
                    }
                });
            },
            select: function (event, ui) {
                if(activeInfoWindow != null) activeInfoWindow.close();
                vendor = markers.find(e => e.getPosition().lat() == ui.item.lat && e.getPosition().lng() == ui.item.lng);

                //If you want panTo animation use this
                map.panTo(vendor.getPosition());
                setTimeout(() => {
                    google.maps.event.trigger(vendor,'click');
                }, 1000);

                //Without animation use this
                // google.maps.event.trigger(vendor,'click');
            }
        }).data("ui-autocomplete")._renderItem = function( ul, item ) {
			return $( "<li class='list-group-item list-group-item-action'></li>" )
				.data( "item.autocomplete", item )
				.append(item.label+', '+item.addr)
				.appendTo(ul);
		};

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
                title : name,
                sign: id
            });
            markers.push(marker);

            marker.addListener("click", () => {
                //Info Distance
                var distance = String(CalcDist(curloc, location).toFixed(2))+" KM";
                //URL image
                var storeImage = "{!! asset('storeimages/"+image+"') !!}";
                var urlStore = "{{ route('order.create', ":id") }}";
                urlStore = urlStore.replace(':id', id);

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
                "<p class='mb-2 mt-2'>Buat pesanan, <a href='"+urlStore+"' class='btn btn-info btn-sm' >Order Sekarang</a></p>" +
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

        locationButton.addEventListener("click", () => {
            map.panTo(curloc);
            initVendorNear(curloc.lat(), curloc.lng());
        });

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

    function panTo(latitude, longitude) {
        if(activeInfoWindow != null) activeInfoWindow.close();
        vendor = markers.find(e => e.getPosition().lat() == latitude && e.getPosition().lng() == longitude);

        //If you want panTo animation use this
        map.panTo(vendor.getPosition());
        setTimeout(() => {
            google.maps.event.trigger(vendor,'click');
        }, 1000);
    }

    function initVendorNear(latitude, longitude) {
        $.ajax({
            url: '{{ route('store-nearby') }}',
            type: 'post',
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                latitude: latitude,
                longitude: longitude
            },
            success: function( data ) {
                let target = $('#nearby-vendor');

                target.html('');
                data.map((value) => {
                    target.append(`<li class="row mt-3 store-near" onclick="panTo(${value.latitude}, ${value.longitude})">
                        <div class="col-md-2">
                            <img src="{{ asset('storeimages/${value.image}') }}" height="70" width="70" style="border-radius: 50px;" alt="">
                        </div>
                        <div class="col-md-8">
                            <h6>${value.name}</h6>
                            <p>${value.address}</p> 
                            <p>Berjarak ${value.distance.toFixed(2)} KM dari lokasi anda</p>
                        </div>
                    </li>`);
                });
            }
        });
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
