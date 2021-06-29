<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="TemplateMo">

        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Additional CSS Files -->
        <link rel="stylesheet" type="text/css" href="{{ asset('landing_page/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('landing_page/css/font-awesome.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('landing_page/css/templatemo-art-factory.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('landing_page/css/owl-carousel.css') }}" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">

        @stack('stylesheet')

        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">

        <!-- ***** Preloader Start ***** -->
        <div id="preloader">
            <div class="jumper">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <!-- ***** Preloader End ***** -->

        @include('layouts.landing.navigation')

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        @guest
            <div class="shadow-sm" style="bottom:50px; right:20px;position: fixed;z-index:9999999">
                <div class="" style="position: relative">
                    <button type="button" class="login" data-toggle="modal" data-target="#loginModal">
                        Login
                    </button>
                    <button class="login" data-toggle="modal" data-dismiss="modal" data-target="#regModalCustomer"> Daftar Akun </button>
                </div>
            </div>
        @else
            <div class="shadow-sm" style="bottom:50px; right:20px;position: fixed;z-index:9999999">
                <div class="row" style="position: relative">
                    <button class="login" data-toggle="modal" data-dismiss="modal" data-target="#regModalStore"> Daftar Mitra </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="{{ route('admin') }}" class="login" style="margin-right: 5px"> Admin Page </a>
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();" class="login">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>

        @endguest

        @include('layouts.landing.footer')
        @include('layouts.landing.modal.login-modal')
        @include('layouts.landing.modal.register-modal-customer')
        @include('layouts.landing.modal.register-modal-store')

        <script>
            $(document).ready(function() {
                console.log('test');
            });
        </script>
        @stack('scripts')
    </body>
</html>
