<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title inertia>{{ config('app.name', 'My USA Career') }}</title>
        <link rel="icon" type="image/png" href="{{ url('images/favicon-ico.png') }}">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])

        <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
        <!--[if lt IE 9]><script src="{{ url('js/respond.js') }}"></script><![endif]-->
        @inertiaHead
    </head>
    <body data-anm=".anm">
    <div class="page-wrapper">
        <!-- Preloader -->
        <div class="preloader"></div>

        @inertia

    </div>

    <script src="{{ url('js/jquery.js') }}"></script>
    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/chosen.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/jquery.fancybox.js') }}"></script>
    <script src="{{ url('js/jquery.modal.min.js') }}"></script>
    <script src="{{ url('js/appear.js') }}"></script>
    <script src="{{ url('js/anm.min.js') }}"></script>
    <script src="{{ url('js/ScrollMagic.min.js') }}"></script>
{{--    <script src="{{ url('js/rellax.min.js') }}"></script>--}}
    <script src="{{ url('js/owl.js') }}"></script>
    <script src="{{ url('js/wow.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>
    </body>
</html>
