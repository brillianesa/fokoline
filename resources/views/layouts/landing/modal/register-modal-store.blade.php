<!-- Modal -->
<div class="modal fade" id="regModalStore" tabindex="-1" role="dialog" aria-labelledby="regModalStoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content" style="margin-top:5%; border-radius: 20px; background-color: #45A1FF;">
        <div class="modal-body text-light" style="background-color: #45A1FF;border-radius: 20px;">
        <h1 class="text-center mt-4"> {{ Str::upper(config('app.name', 'LARAVEL')) }} </h4>
          <h5 class="text-center mt-4"> Pendaftaran Mitra </h5>
          <br>
  
          <!-- Session Status -->
          <x-auth-session-status class="mb-4" :status="session('status')" />
  
          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />

          <div class="bs-stepper">
            <div class="bs-stepper-header justify-content-md-center mb-3" role="tablist">
              <!-- your steps here -->
              <div class="col col-lg-2"></div>
              <div class="step col col-md-auto" data-target="#register-part">
                <button type="button" class="step-trigger text-light" role="tab" aria-controls="register-part" id="register-part-trigger">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">Pendaftaran</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step col col-md-auto" data-target="#verify-part">
                <button type="button" class="step-trigger text-light" role="tab" aria-controls="verify-part" id="verify-part-trigger" >
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">Verifikasi</span>
                </button>
              </div>
              <div class="col col-lg-2"></div>
            </div>
            <div class="bs-stepper-content">
              <!-- your steps content here -->
              <div id="register-part" class="content fade" role="tabpanel" aria-labelledby="register-part-trigger">
                <form id="registerStoreStep1" class="ml-4 mr-4" method="POST" action="">
                    @csrf
                    <!-- Name -->
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          {{-- <label for="name"> Name </label> --}}
                          <input type="text" placeholder="Nama" class="form-control" name="name" type="name" value="{{ old('name') }}" required>
                          </div>
          
                        <!-- Email Address -->
                        <div class="form-group">
                            {{-- <label for="email"> Email </label> --}}
                            <input type="text" placeholder="Email" class="form-control" name="email" type="email" value="{{ old('email') }}" required>
                        </div>
          
                        <!-- No. Telp -->
                        <div class="form-group">
                          {{-- <label for="notelp"> No. Telp </label> --}}
                          <input type="text" placeholder="No. Telp" class="form-control" name="notelp" type="notelp" value="{{ old('notelp') }}" required>
                          </div>
            
                        <!-- Password -->
                        <div class="form-group">
                            {{-- <label for="password"> Password </label> --}}
                            <input type="password" placeholder="Password" class="form-control" name="password" type="password" required>
                        </div>
          
                        <!-- Password -->
                        <div class="form-group">
                              {{-- <label for="password_confirmation"> Confirm Password </label> --}}
                              <input type="password" placeholder="Password lagi" class="form-control" name="password_confirmation" required>
                        </div>
                      </div>
                      <div class="col-md-1"></div>
                      <div class="col-md-6">
                            <div> <!-- Map -->
                              {{-- <img id="map" class="img-thumbnail" style="width: 500px; height: 300px"> --}}
                              <canvas id="map" class="img-thumbnail" width="500" height="300">
                                Your browser does not support the HTML canvas tag.</canvas>
                            </div>
                      </div>
                    </div>
                      <div class="text-right">
                          <button type="button" onclick="nextStep()" class="btn btn-light mt-4" style="border-radius: 40px; padding-right: 65px; position: relative;">Lanjut <i class="fa fa-arrow-right" style="position: absolute; right: 10%; top: 31%;" aria-hidden="true"></i></button>
                      </div>
                </form>
              </div>
              <div id="verify-part" class="content fade" role="tabpanel" aria -labelledby="verify-part-trigger">
                <form id="registerStoreStep2" class="ml-4 mr-4" method="POST" action="">
                  @csrf
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group"> <!-- Nama Vendor -->
                        <input type="text" placeholder="Nama Vendor" class="form-control" name="storename" value="{{ old('storename') }}" required>
                        </div>
        
                      <div class="form-group"> <!-- Bank Acc -->
                          <input type="text" placeholder="Bank Acc" class="form-control" name="bankacc" value="{{ old('bankacc') }}" required>
                      </div>

                      <div class="form-group"> <!-- No Rekening -->
                        <input type="text" placeholder="No. Rek" class="form-control" name="accnum" value="{{ old('accnum') }}" required>
                      </div>
        
                      <div class="form-group"> <!-- Alamat Vendor -->
                        <input type="text" placeholder="Alamat Vendor" class="form-control" name="storeaddr" value="{{ old('storeaddr') }}" required>
                      </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                          <div> <!-- Input File -->
                            <input type="file" style="visibility: hidden;position: absolute;" name="img[]" class="file" accept="image/*">
                            <div class="input-group">
                              <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                              <div class="input-group-append">
                                <button type="button" class="browse btn btn-primary">Browse...</button>
                              </div>
                            </div>
                            <img id="preview" class="img-thumbnail" style="width: 500px; height: 300px">
                          </div>
                    </div>
                  </div>
                </form>               
                  <button type="button" onclick="nextPrev()" class="btn btn-light mt-4" style="border-radius: 40px; padding-left: 50px; position: relative;"><i class="fa fa-arrow-left" style="position: absolute; left: 10%; top: 31%;" aria-hidden="true"></i>Kembali</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    //Stepper
    var stepper = new Stepper($('.bs-stepper')[0]);
    stepper.next();
    stepper.previous();
    stepper.options.animation = true;
    var nextStep = () => {
        stepper.next();
    }
    var nextPrev = () => {
        stepper.previous();
    }

    //Input File
    $(document).on("click", ".browse", function() {
      var file = $(this).parents().find(".file");
      file.trigger("click");
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

    //Map
    var c = document.getElementById("map");
    var ctx = c.getContext("2d");
    ctx.font = "30px Arial";
    ctx.fillText("Map disini . . .",10,50);
  </script>