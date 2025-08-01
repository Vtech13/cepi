<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>

    {{-- @todo: favicon --}}
    <link href="/favicon.png" type="image/x-icon" rel="icon"/>
    <link href="/favicon.png" type="image/x-icon" rel="shortcut icon"/>
    <!--[if IE]>
    <link href="/favicon.ico" type="image/x-icon" rel="icon"/>
    <link href="/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
    <![endif]-->

    <link rel="dns-prefetch" href="//fonts.googleapis.com"
          title="Dentiste Pauline Pagbe">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="layout-login">
<div class="wrap">
    <div class="main-content">
        <noscript>
            <p class="no-script">For a better experience on {{ config('app.name') }}, enable JavaScript in your
                browser</p>
        </noscript>

        @include('partials.flash')

        <section class="section">
            <div class="container">
                <div class="form-login">
                    <form action="{{ route('login') }}" method="post" class="form">
                        @csrf

                        <div class="form__block">
                            <label for="email" class="form__label">Email</label>
                            <input type="email" class="form__input" name="email" id="email" required value="{{ old('email') }}">
                        </div>
                        <div class="form__block">
                            <label for="password" class="form__label">Password</label>
                            <input type="password" class="form__input" name="password" id="password" required>
                        </div>

                        <button type="submit" class="form__submit">Login</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <div class="push"></div>
</div>

</body>
</html>
