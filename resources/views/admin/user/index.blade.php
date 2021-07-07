<x-admin-layout>

    @push('stylesheet')
        <style>
            .img-preview {
                display: block;
                margin: 0 auto;
                max-height: 300px;
                max-width: 300px;
            }
        </style>
    @endpush
    <section class="content-header">
        <h1>
            Pengaturan
        </h1>
    </section>

    <section class="content container-fluid">
        <div class="row">

            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Pengaturan User</h3>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('user.update.profile') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for=""> Nama </label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>

                            <div class="form-group">
                                <label for=""> Email </label>
                                <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                            </div>

                            <div class="form-group">
                                <label for=""> Password </label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for=""> Password </label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success pull-right"> Update </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if ($store)
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Pengaturan Toko</h3>
                    </div>
                    <div class="box-body">

                        <form action="{{ route('user.update.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="store_id" value="{{ $store->id }}">

                            <div class="form-group">
                                <img src="{{ asset('storeimages/' . $store->image) }}" id="preview" class="img-responsive img-centered img-preview" height="300" width="300" alt="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for=""> Foto </label>
                                <input type="file" accept="image/png, image/gif, image/jpeg, image/jpg" name="image" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label for=""> Nama Vendor </label>
                                <input type="text" name="name" value="{{ $store->name }}" class="form-control">
                            </div>

                            <div class="form-group col-md-12">
                                <label for=""> Metode Pembayaran </label>
                                <a class="btn btn-primary btn-xs" style="cursor: pointer" id="payment-method"> + </a>

                                @php
                                    $list_pembayaran = json_decode($store->payment_list) ?? [];
                                @endphp


                                @foreach ($list_pembayaran as $key => $value)
                                    <div class="row" id="payment-{{ $key }}">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="payment_list[]" value="{{ $value }}"placeholder="Contoh : BCA - 00011111">
                                        </div>
                                        <div class="col-md-5">
                                            <a class="btn btn-danger delete-payment input-group-text" data-id="{{ $key }}" style="cursor: pointer"> - </a>
                                        </div>
                                    </div>
                                @endforeach
                                <div id="payment-list"></div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for=""> Alamat </label>
                                <textarea name="address" cols="30" rows="10" class="form-control" id="address">{{ $store->address }}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label for=""> Lokasi Maps </label>

                                <input type="text" id="search" class="form-control" value="{{ $store->address }}">

                                <input type="hidden" name="latitude" id="latitude" value="{{ $store->latitude }}">
                                <input type="hidden" name="longitude" id="longitude" value="{{ $store->longitude }}">

                                <div class="col-md-12" id="map" style="height: 500px;"></div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success pull-right"> Update </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </section>

    @push('scripts')

    @if ($store)
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('API_KEY') }}&callback=initMap&libraries=places"type="text/javascript"></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: {{ $store->latitude }},
                    lng: {{ $store->longitude }}
                },
                zoom: 17,
                mapTypeId: "roadmap",
                mapTypeControl: false,
            });

            var input = document.getElementById('search');
            const searchBox = new google.maps.places.SearchBox(input);

            var markers = [];
            searchBox.addListener("places_changed", () => {
                console.log('test');
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25),
                    };
                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                            map,
                            icon,
                            title: place.name,
                            position: place.geometry.location,
                        })
                    );

                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }

                    $('#latitude').val(place.geometry.location.lat());
                    $('#longitude').val(place.geometry.location.lng());
                    $('#address').val(place.formatted_address);
                });
                map.fitBounds(bounds);

                // $('#latitude').val(place.geometry.location)
            });

            // set current location marker
            var marker2 = new google.maps.Marker({
                position: new google.maps.LatLng({{ $store->latitude}}, {{ $store->longitude}}),
                map: map
            });

            //Listener
            google.maps.event.addListener(map, 'click', function(event) {
                placeMarkerIputM2(this, event.latLng);
                latlonglocation = event.latLng.toJSON();

                $('#latitude').val(latlonglocation.lat);
                $('#longitude').val(latlonglocation.lng);
            });

            function placeMarkerIputM2(map, node) {
                marker2.setPosition(node);
                map.panTo(marker2.getPosition());
            }
        }
    </script>

    <script>
        $(document).ready(function() {
              $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $("#file").val(fileName);

                var reader = new FileReader();
                reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            });
        })

        let paymentNumber = {{ count($list_pembayaran) }};
        $(document).on("click", "#payment-method", function() {
            let paymentList = $('#payment-list');

            paymentList.append(`
                <div class="row" id="payment-${paymentNumber}">
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="payment_list[]" placeholder="Contoh : BCA - 00011111">
                    </div>
                    <div class="col-md-5">
                        <a class="btn btn-danger delete-payment input-group-text" data-id="${paymentNumber}" style="cursor: pointer"> - </a>
                    </div>
                </div>
            `);

            paymentNumber++;
        });

        $(document).on('click', '.delete-payment', function() {
            let id = $(this).data('id');
            $(`#payment-${id}`).remove();
        });
    </script>
    @endif


    @endpush
</x-app-layout>
