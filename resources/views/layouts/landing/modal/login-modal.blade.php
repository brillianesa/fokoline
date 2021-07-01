<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="margin-top:50%; border-radius: 20px; background-color: #45A1FF;">
      <div class="modal-body text-light" style="background-color: #45A1FF;border-radius: 20px;">
      <h1 class="text-center mt-4"> {{ Str::upper(config('app.name', 'LARAVEL')) }} </h4>
        <h5 class="text-center mt-4"> Login </h5>
        <br>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form class="ml-4 mr-4" method="POST" action="{{ route('login') }}">
          @csrf
          <!-- Email Address -->
          <div class="form-group">
              <label for="email"> Email </label>
              <input type="text" class="form-control" name="email" type="email" value="{{ old('email') }}" required>
          </div>

          <!-- Password -->
          <div class="form-group">
              <label for="password"> Password </label>
              <input type="password" class="form-control" name="password" type="password" required>
          </div>

          {{-- <div class="form-group">
              <button type="submit" class="btn btn-primary float-right"> Login </button>
          </div> --}}
          <div class="form-group" style="margin-top: 50px">
              <button type="button" class="btn btn-light" data-toggle="modal" data-dismiss="modal" data-target="#regModalCustomer" style="border-radius: 40px; padding-inline: 50px">Daftar</button>
              <button type="submit" class="btn btn-light float-right" style="border-radius: 40px; padding-inline: 50px">Login</button>
          </div>
        </form>
          {{-- <div class="signup-section">Belum punya akun? <a href="#a" class="text-info" data-toggle="modal" data-dismiss="modal" data-target="#regModalCustomer"> Buat akun </a>.</div> --}}
      </div>
    </div>
  </div>
</div>
@push('scripts')
  <script>
    if ("{{Request::get('mustlogin', false)}}") {
      $('#loginModal').modal('show');
    }
  </script>
@endpush
