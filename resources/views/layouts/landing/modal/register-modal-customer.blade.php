<!-- Modal -->
<div class="modal fade" id="regModalCustomer" tabindex="-1" role="dialog" aria-labelledby="regModalCustomerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="margin-top:40%; border-radius: 20px; background-color: #45A1FF;">
        <div class="modal-body text-light" style="background-color: #45A1FF;border-radius: 20px;">
        <h1 class="text-center mt-4"> {{ Str::upper(config('app.name', 'LARAVEL')) }} </h4>
          <h5 class="text-center mt-4"> Pendaftaran </h5>
          <br>
  
          <!-- Session Status -->
          <x-auth-session-status class="mb-4" :status="session('status')" />
  
          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />
  
          <form class="ml-4 mr-4" method="POST" action="{{ route('register') }}">
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
                <div class="text-center">
                    <button type="submit" class="btn btn-light" style="border-radius: 40px; padding-inline: 50px">DAFTAR</button>
                  </div>
                  {{-- <button type="submit" class="btn btn-primary btn-circle center"> Login </button> --}}
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  