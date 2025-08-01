@extends('layouts.app')

@section('content')
    <section class="section section--top bg-img">
        <div class="container">
            <h1 class="title title--h1">
                {{ $blocks['main_title']->title }}
            </h1>
        </div>
    </section>

    <section class="section section-soins-categories">
        <div class="container">
            <div class="soins-categories">
                <div class="box-icon">
                    <a href="#chirurgie-buccale" class="box-icon__link" data-scroll-to="#chirurgie-buccale">
                        <x-icon-svg name="chirurgie-buccale"/>
                        <p class="box-icon__title">Chirurgie buccale</p>
                    </a>
                </div>
                <div class="box-icon">
                    <a href="#esthetique" class="box-icon__link" data-scroll-to="#esthetique">
                        <x-icon-svg name="soins-esthetique"/>
                        <p class="box-icon__title">Esthétique dentaire</p>
                    </a>
                </div>
                <div class="box-icon">
                    <a href="#endodontie" class="box-icon__link" data-scroll-to="#endodontie">
                        <x-icon-svg name="endodontie"/>
                        <p class="box-icon__title">Endodontie</p>
                    </a>
                </div>
                <div class="box-icon">
                    <a href="#parodontologie" class="box-icon__link" data-scroll-to="#parodontologie">
                        <x-icon-svg name="parodontologie"/>
                        <p class="box-icon__title">Parodontologie</p>
                    </a>
                </div>
                <div class="box-icon">
                    <a href="#implantologie" class="box-icon__link" data-scroll-to="#implantologie">
                        <x-icon-svg name="implant-dentaire"/>
                        <p class="box-icon__title">Implantologie</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-chirurgie-buccale" id="chirurgie-buccale">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title">
                    {{ $blocks['chirurgie-buccale']->title ?? '' }}
                </p>
                <div class="block-text__content t-center">
                    @if (!empty($blocks['chirurgie-buccale']->videos))
                        <div class="row">
                            @foreach($blocks['chirurgie-buccale']->videos as $video)
                                <div class="col-xs-12 col-sm-4">
                                    <div class="t-center">
                                        <iframe width="560" height="315"
                                                src="https://www.youtube-nocookie.com/embed/{{ $video->name }}" frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                    </div>
                                    @if (!empty($video->title))
                                        <p class="t-center">{{ $video->title }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <hr class="line">

    <section class="section section-esthetique" id="esthetique">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title">
                    {{ $blocks['esthetique']->title }}
                </p>
                <div class="block-text__content t-center">
                    @if (!empty($blocks['esthetique']->videos))
                        <div class="row">
                            @foreach($blocks['esthetique']->videos as $video)
                                <div class="col-xs-12 col-sm-4">
                                    <div class="t-center">
                                        <iframe width="560" height="315"
                                                src="https://www.youtube-nocookie.com/embed/{{ $video->name }}" frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                    </div>
                                    @if (!empty($video->title))
                                        <p class="t-center">{{ $video->title }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <hr class="line">

    <section class="section section-endodontie" id="endodontie">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title">
                    {{ $blocks['endodontie']->title ?? '' }}
                </p>
                <div class="block-text__content t-center">
                    @if (!empty($blocks['endodontie']->videos))
                        <div class="row">
                            @foreach($blocks['endodontie']->videos as $video)
                                <div class="col-xs-12 col-sm-4">
                                    <div class="t-center">
                                        <iframe width="560" height="315"
                                                src="https://www.youtube-nocookie.com/embed/{{ $video->name }}" frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                    </div>
                                    @if (!empty($video->title))
                                        <p class="t-center">{{ $video->title }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <hr class="line">

    <section class="section section-parodontologie" id="parodontologie">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title">
                    {{ $blocks['parodontologie']->title }}
                </p>
                <div class="block-text__content">
                    @if (!empty($blocks['parodontologie']->videos))
                        <div class="row">
                            @foreach($blocks['parodontologie']->videos as $video)
                                <div class="col-xs-12 col-sm-4">
                                    <div class="t-center">
                                        <iframe width="560" height="315"
                                                src="https://www.youtube-nocookie.com/embed/{{ $video->name }}" frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                    </div>
                                    @if (!empty($video->title))
                                        <p class="t-center">{{ $video->title }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <hr class="line">

    <section class="section section-implantologie" id="implantologie">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title">
                    {{ $blocks['implantologie']->title }}
                </p>
                <div class="block-text__content">
                    @if (!empty($blocks['implantologie']->videos))
                        <div class="row">
                            @foreach($blocks['implantologie']->videos as $video)
                                <div class="col-xs-12 col-sm-4">
                                    <div class="t-center">
                                        <iframe width="560" height="315"
                                                src="https://www.youtube-nocookie.com/embed/{{ $video->name }}" frameborder="0"
                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>
                                    </div>
                                    @if (!empty($video->title))
                                        <p class="t-center">{{ $video->title }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
