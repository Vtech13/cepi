<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- @todo: meta --}}
    <title>{{ config('app.name') }}</title>

    {{-- @todo: meta --}}
    <meta name="description" content="">

    {{-- @todo: favicon --}}
    <link href="/favicon.png" type="image/x-icon" rel="icon"/>
    <link href="/favicon.png" type="image/x-icon" rel="shortcut icon"/>
    <!--[if IE]>
    <link href="/favicon.ico" type="image/x-icon" rel="icon"/>
    <link href="/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
    <![endif]-->

    <link rel="dns-prefetch" href="//fonts.googleapis.com"
          title="Dentiste Pauline Pagbe">

    @yield('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">z
</head>
<body class="layout-default {{ !empty($class_body) ? $class_body : '' }}">
<div class="wrap">
    @include('partials.header')
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
@include('partials.footer')

@yield('js')
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
