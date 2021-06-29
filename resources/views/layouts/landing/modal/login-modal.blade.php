<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="margin-top:50%">
      <div class="modal-body">
        <h4 class="text-center"> Login </h4>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
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

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right"> Login </button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="signup-section">Belum punya akun? <a href="#a" class="text-info" data-toggle="modal" data-dismiss="modal" data-target="#regModalCustomer"> Buat akun </a>.</div>
        {{-- <button type="button" class="login" data-toggle="modal" data-dismiss="modal" data-target="#regModalCustomer">
          Daftar
        </button> --}}
      </div>
    </div>
  </div>
</div>
