<!-- Modal -->
<div class="modal fade" id="regModalStore" tabindex="-1" role="dialog" aria-labelledby="regModalStoreLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="margin-top:20%; border-radius: 20px; background-color: #45A1FF;">
        <div class="modal-body text-light" style="background-color: #45A1FF;border-radius: 20px;">
        <h1 class="text-center mt-4"> {{ Str::upper(config('app.name', 'LARAVEL')) }} </h4>
          <h5 class="text-center mt-4"> Pendaftaran Mitra </h5>
          <br>
  
          <!-- Session Status -->
          <x-auth-session-status class="mb-4" :status="session('status')" />
  
          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />

          <div class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
              <!-- your steps here -->
              <div class="step" data-target="#logins-part">
                <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">Logins</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#information-part">
                <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" >
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">Various information</span>
                </button>
              </div>
            </div>
            <div class="bs-stepper-content">
              <!-- your steps content here -->
              <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                <form class="ml-4 mr-4" method="POST" action="">
                    @csrf
                    <!-- Name -->
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
                    <div class="form-group" style="margin-top: 50px">
                      <div class="text-right">
                          <button type="button" onclick="nextStep()" class="btn btn-light" style="border-radius: 40px; padding-right: 15%; position: relative;">Lanjut <i class="fa fa-arrow-right" style="position: absolute; right: 10%; top: 31%;" aria-hidden="true"></i></button>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary btn-circle center"> Login </button> --}}
                    </div>
                </form>
              </div>
              <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                  <!-- Password -->
                  <h1>Map ...</h1>
                  <button type="button" onclick="nextPrev()" class="btn btn-light" style="border-radius: 40px; padding-left: 13%; position: relative;"><i class="fa fa-arrow-left" style="position: absolute; left: 10%; top: 31%;" aria-hidden="true"></i>Kembali</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var stepper = new Stepper($('.bs-stepper')[0])
    var nextStep = () => {
        stepper.next();
    }
    var nextPrev = () => {
        stepper.previous();
    }
  </script>