<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('favicon.png') }}" type="image/x-icon" rel="icon"/>
    <link href="{{ asset('favicon.png') }}" type="image/x-icon" rel="shortcut icon"/>
    <!--[if IE]>
    <link href="{{ asset('favicon.ico') }}" type="image/x-icon" rel="icon"/>
    <link href="{{ asset('favicon.ico') }}" type="image/x-icon" rel="shortcut icon"/>
    <![endif]-->

    <link rel="stylesheet" href="{{ asset('css/platform.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js?2024"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <!-- Ajoutez ceci dans la section <head> de votre fichier blade -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="{{ $classBody ?? '' }}">

<div class="wrap">
    <x-header :active="$linkActive"></x-header>

    {{ $sidebar ?? null }}

    <main class="main-content">
        <noscript>
            <p class="no-script">For a better experience on {{ config('app.name') }}, enable JavaScript in your
                browser</p>
        </noscript>

        <x-flash></x-flash>

        {{ $slot }}
    </main>
</div>

<script src="{{ asset('js/platform.js') }}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</body>
</html>
