<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>

    <meta name="robots" content="noindex, nofollow, noarchive">

    <link href="/favicon.png" type="image/x-icon" rel="icon"/>
    <link href="/favicon.png" type="image/x-icon" rel="shortcut icon"/>
    <!--[if IE]>
    <link href="/favicon.ico" type="image/x-icon" rel="icon"/>
    <link href="/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
    <![endif]-->

    <link rel="dns-prefetch" href="//fonts.googleapis.com" title="Dentiste Pauline Pagbe">

    @yield('css')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body class="layout-admin {{ !empty($class_body) ? $class_body : '' }}">
<div class="wrap">

    @include('admincms.partials.header')

    <div class="sidebar-wrapper"></div>

    <div class="main-content">
        <noscript>
            <p class="no-script">For a better experience on {{ config('app.name') }}, enable JavaScript in your
                browser</p>
        </noscript>

        @include('partials.flash')
        @yield('content')
    </div>

    <div class="push"></div>
</div>

<footer class="footer"></footer>

@yield('js')
<script src="{{ asset('js/admin.js') }}" defer></script>

</body>
</html>
