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

        <style>
            .map-with-table {
                width: 100%;
                padding-right: 100px;
                padding-left: 100px;
                margin-right: auto;
                margin-left: auto;
            }

        </style>
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
            <div class="" style="top:30px; right:30px;position: fixed;z-index:9999999">
                <div class="" style="position: relative">
                    <button class="login shadow-sm" data-dismiss="modal" data-toggle="modal" data-target="#loginModal" onclick="$('#regModalCustomer').modal('hide')"> Login </button>

                </div>
            </div>
        @else
            <div class="" style="top:30px; right:30px;position: fixed;z-index:9999999">
                <div class="row" style="position: relative">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="{{ route('dashboard') }}" class="login shadow-sm" style="margin-right: 5px"> {{ auth()->user()->role }} Page </a>

                        @if (auth()->user()->role == 'customer')
                            <a href="" class="login shadow-sm" data-toggle="modal" data-dismiss="modal" data-target="#regModalStore"> Daftar Mitra </button>
                        @endif
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();" class="login shadow-sm">
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

            });
        </script>
        @stack('scripts')
    </body>
</html>
