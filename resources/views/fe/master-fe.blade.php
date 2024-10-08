<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/vuejs-fill.png') }}"> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
        rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <!-- for swipper slider -->
        <Link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
        <!-- for fancy box -->
        <Link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    </head>
    <body>
        @include('fe/header')
        @yield('content')
        @include('fe/footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <!-- for jquery  -->
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>

        <!-- for swiper slider  -->
        <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    
        <!-- for fancy box  -->
        <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
        <script src="{{ asset('assets/js/slider.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>