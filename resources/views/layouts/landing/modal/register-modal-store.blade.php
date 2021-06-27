<!-- Modal -->
<div class="modal fade" id="regModalStore" tabindex="-1" role="dialog" aria-labelledby="regModalStoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content" style="margin-top:10%; border-radius: 20px; background-color: #45A1FF;">
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
                <form class="ml-4 mr-4" method="POST" action="">
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

                      <div class="col-md-7">
                      </div>
                    </div>
                    <div class="form-group" style="margin-top: 50px">
                      <div class="text-right">
                          <button type="button" onclick="nextStep()" class="btn btn-light" style="border-radius: 40px; padding-right: 65px; position: relative;">Lanjut <i class="fa fa-arrow-right" style="position: absolute; right: 10%; top: 31%;" aria-hidden="true"></i></button>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary btn-circle center"> Login </button> --}}
                    </div>
                </form>
              </div>
              <div id="verify-part" class="fade content" role="tabpanel" aria -labelledby="verify-part-trigger">
                  <!-- Password -->
                  <h1>Map ...</h1>
                  <button type="button" onclick="nextPrev()" class="btn btn-light mt-4" style="border-radius: 40px; padding-left: 50px; position: relative;"><i class="fa fa-arrow-left" style="position: absolute; left: 10%; top: 31%;" aria-hidden="true"></i>Kembali</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
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
  </script>