<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('favicon.png') }}" type="image/x-icon" rel="icon"/>
    <link href="{{ asset('favicon.png') }}" type="image/x-icon" rel="shortcut icon"/>
    <!--[if IE]>
    <link href="{{ asset('favicon.ico') }}" type="image/x-icon" rel="icon"/>
    <link href="{{ asset('favicon.ico') }}" type="image/x-icon" rel="shortcut icon"/>
    <![endif]-->

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="{{ $classBody ?? '' }}">

<div class="wrap">
    <main class="main-content">
        <noscript>
            <p class="no-script">For a better experience on {{ config('app.name') }}, enable JavaScript in your
                browser</p>
        </noscript>

        <x-flash></x-flash>

        {{ $slot }}
    </main>
    <div class="push"></div>
</div>

<script src="{{ asset('js/platform.js') }}" defer></script>
</body>
</html>
