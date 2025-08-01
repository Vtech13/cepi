@extends('layouts.app')

@section('content')
    <section class="section section--top bg-img">
        <div class="container">
            <p class="title title--h1 ff-hand">
                {{ $blocks['main_title']->title }}
            </p>
        </div>
    </section>

    <section class="section section__1">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title ff-hand">
                    {{ $blocks['intro']->title }}
                </p>
                <div class="block-text__content t-center">
                    {!! $blocks['intro']->content !!}
                </div>
            </div>

            <div class="soins-categories">
                <div class="box-icon">
                    <a href="{{ route('chirurgie-buccale') }}" class="box-icon__link">
                        <x-icon-svg name="chirurgie-buccale"/>
                        <p class="box-icon__title">Chirurgie buccale</p>
                    </a>
                </div>
                <div class="box-icon">
                    <a href="{{ route('esthetique-dentaire') }}" class="box-icon__link">
                        <x-icon-svg name="soins-esthetique"/>
                        <p class="box-icon__title">Esthétique du sourire</p>
                    </a>
                </div>
                <div class="box-icon">
                    <a href="{{ route('endodontie') }}" class="box-icon__link">
                        <x-icon-svg name="endodontie"/>
                        <p class="box-icon__title">Endodontie</p>
                    </a>
                </div>
                <div class="box-icon">
                    <a href="{{ route('parodontologie') }}" class="box-icon__link">
                        <x-icon-svg name="parodontologie"/>
                        <p class="box-icon__title">Parodontologie</p>
                    </a>
                </div>
                <div class="box-icon">
                    <a href="{{ route('implantologie') }}" class="box-icon__link">
                        <x-icon-svg name="implant-dentaire"/>
                        <p class="box-icon__title">Implantologie</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section section__news">
        <div class="container">
            <p class="title t-center block-text__title">Actualités</p>

            <div class="row">
                @foreach ($posts as $post)
                    <div
                        class="col-xs-12 @if($posts_count === 3) col-sm-4 @elseif($posts_count === 2) col-sm-6 @elseif($posts_count >= 4) col-sm-4 @else col-sm-12 @endif col-jsc">
                        <div class="block-post block-post--vertical">
                            <div class="block-post__img">
                                @if ($post->attachments()->exists())
                                    <img src="{{ $post->attachments()->first()->urlBigCache }}" alt=""
                                         class="img-fluid img-center">
                                @endif
                            </div>
                            <div class="block-post__title">
                                {{ $post->title }}
                            </div>
                            <div class="block-post__text">
                                <p>
                                    {!! \Illuminate\Support\Str::limit(strip_tags($post->content), 400) !!}
                                </p>
                            </div>
                            <div class="block-post__btn">
                                <a href="{{ route('posts.view', $post->slug) }}">
                                    Voir l'actu
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
