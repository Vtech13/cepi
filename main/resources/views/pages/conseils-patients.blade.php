@extends('layouts.app')

@section('content')
    <section class="section section--top bg-img">
        <div class="container">
            <h1 class="title title--h1">
                {{ $blocks['main_title']->title }}
            </h1>
        </div>
    </section>

    <section class="section section__pad-b-0">
        <div class="container">
            <div class="block-text">
                <div class="block-text__content">
                    {!! $blocks['intro']->content !!}
                </div>
            </div>
        </div>
    </section>

    @if ($advice_files->isNotEmpty())
        <section class="section advice-files">
            <div class="container">
                <p class="advice-files__title">Fiches conseils à télécharger</p>
                <ul class="advice-files__listing">
                    @foreach($advice_files as $file)
                        <li>
                            <a href="{{ asset("storage/advice-files/$file->file") }}" target="_blank">
                                {{ $file->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <section class="section posts">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title block-text__title--small">
                    Toutes les actualités
                </p>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    @foreach($posts as $post)
                        <div class="block-post block-post--horizontal">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-asc">
                                    <div class="block-post__img">
                                        @if ($post->attachments()->exists())
                                            <img src="{{ $post->attachments()->first()->urlCache }}" alt=""
                                                 class="img-fluid img-center">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-asc">
                                    <p class="block-post__title">
                                        {{ $post->title }}
                                    </p>
                                    <div class="block-post__text">
                                        {!! \Illuminate\Support\Str::limit(strip_tags($post->content), 200) !!}
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-6 col-asc">
                                            <p class="block-post__date">
                                                @if ($post->created_at->diffInDays(today()) > 7)
                                                    le {{ $post->created_at->locale('fr_FR')->isoFormat('LL') }}
                                                @else
                                                    {{ $post->created_at->locale('fr')->diffForHumans() }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-xs-6 col-asc">
                                            <div class="block-post__btn">
                                                <a href="{{ route('posts.view', $post->slug) }}">
                                                    Voir l'actu
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="block-post__line"></div>
                    @endforeach
                </div>
                <div class="col-xs-12 col-sm-4">
                    @include('posts._sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
