<!-- Modal -->
<style>
  .pac-container {
    background-color: #FFF;
    z-index: 20;
    position: fixed;
    display: inline-block;
    float: left;
}

.modal{
    z-index: 20;
}

.modal-backdrop{
  z-index: 10;
}
</style>
<div class="modal fade" id="regModalStore" tabindex="-1" role="dialog" aria-labelledby="regModalStoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content" style="margin-top:8%; border-radius: 20px; background-color: #45A1FF;">
        <div class="modal-body text-light" style="background-color: #45A1FF;border-radius: 20px;">
        <h1 class="text-center mt-4"> {{ Str::upper(config('app.name', 'LARAVEL')) }} </h4>
          <h5 class="text-center mt-4"> Pendaftaran Mitra </h5>
          <br>

          <!-- Session Status -->
          <x-auth-session-status class="mb-4" :status="session('status')" />

          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />
          <form id="registerStoreStep2" class="ml-4 mr-4 mt-8" method="POST" action="{{ route('register-store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-5">
                <div class="form-group"> <!-- Nama Vendor -->
                  <input type="text" placeholder="Nama Vendor" class="form-control" name="storename" value="{{ old('storename') }}" required>
                  </div>

                <div class="form-group"> <!-- Alamat Vendor -->
                  <input type="text" placeholder="Alamat Vendor" class="form-control" name="storeaddr" value="{{ old('storeaddr') }}" required>
                </div>

                <div class="form-group"> <!-- Alamat Vendor -->
                  <input type="text" placeholder="Nomor Telepon" class="form-control" name="notelp" value="{{ old('notelp') }}" required>
                </div>

                <div class="form-group"> <!-- Input File -->
                  <input type="file" style="visible:hidden; position: absolute;" name="img" class="file" accept="image/*">
                  <div class="input-group">
                    <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                    <div class="input-group-append">
                      <button type="button" class="browse btn btn-primary">Browse...</button>
                    </div>
                  </div>
                  <img id="preview" class="img-thumbnail" style="width: 450px; height: 200px">
                </div>

                <div class="form-group">
                    <label for=""> Metode Pembayaran </label>
                    <a class="btn btn-warning float-right" style="cursor: pointer" id="payment-method"> + </a>

                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="payment[]" placeholder="Contoh : BCA - 00011111">
                        <div id="payment-list"></div>
                    </div>
                </div>
              </div>
              <div class="col-md-1"></div>
              <div class="col-md-6 text-dark">
                <input id="pac-input" class="form-control" type="text" placeholder="Search Box"/>
                <div id="mapinput" class="img-thumbail" style="width: 514px; height: 300px"></div>
              </div>
              <div>
                <input type="text" name="lat" id="lat" hidden>
                <input type="text" name="lng" id="lng" hidden>
              </div>
            </div>
            <div class="text-right">
              <button type="submit" onclick="nextStep(this)" class="btn btn-light mt-4" style="border-radius: 40px; position: relative;"> Submit </button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@push('scripts')
<script>
  //Form
  var latlonginput;
  var fileinput = null;
  var nextStep = (e) => {
    var spanLoad = e.getElementsByTagName('span')[0];
    spanLoad.setAttribute('class', 'spinner-border spinner-border-sm');
    e.disabled = true;

    setTimeout(() => {
      spanLoad.setAttribute('class', 'fa fa-arrow-right');
      e.disabled = false;
      $('#lat').val(String(latlonginput.lat));
      $('#lng').val(String(latlonginput.lng));
      $('form#registerStoreStep2').submit();
    }, 1000);
  }
</script>

<script>
    //Input File
    $(document).on("click", ".browse", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });

    let paymentNumber = 1;
    $(document).on("click", "#payment-method", function() {
        let paymentList = $('#payment-list');

        paymentList.append(`
            <div class="input-group" id="payment-${paymentNumber}">
                <input type="text" class="form-control" name="payment[]" placeholder="Contoh : BCA - 00011111">
                <a class="btn btn-danger delete-payment" data-id="${paymentNumber}" style="cursor: pointer"> - </a>
            </div>
        `);

        paymentNumber++;
    });

    $(document).on('click', '.delete-payment', function() {
        let id = $(this).data('id');
        $(`#payment-${id}`).remove();
    });

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
</script>

<script>

// let map2, infoWindow2;

function initAutocomplete() {
  const map2 = new google.maps.Map(document.getElementById("mapinput"), {
    center: { lat: -6.372834730710882, lng: 106.77591157286359 },
    zoom: 13,
    mapTypeId: "roadmap",
    mapTypeControl: false,
  });
  // Create the search box.
  const inputS = document.getElementById("pac-input");
  const searchBox = new google.maps.places.SearchBox(inputS);
  let markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", () => {
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
          map2,
          icon,
          title: place.name,
          position: place.geometry.location,
        })
      );

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map2.fitBounds(bounds);
  });


 //Marker
 var marker2 = new google.maps.Marker({
      position: new google.maps.LatLng(-6.372834730710882, 106.77591157286359),
      map: map2
    });
    latlonginput = marker2.getPosition().toJSON();
 function placeMarkerIputM2(map, node) {
    marker2.setPosition(node);
    map.panTo(marker2.getPosition());
  }

  //Listener
  google.maps.event.addListener(map2, 'click', function(event) {
    placeMarkerIputM2(this, event.latLng);
    latlonginput = event.latLng.toJSON();

    $('#lat').val(latlonginput.lat);
    $('#lng').val(latlonginput.lng);
  });
}
</script>
@endpush
