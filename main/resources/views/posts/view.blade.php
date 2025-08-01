@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <div class="post-view">
                        <h1 class="post-view__title">{{ $post->title }}</h1>

                        <div class="post-view__image">
                            @if ($post->attachments()->exists())
                                <img src="{{ $post->attachments()->first()->urlBigCache }}" alt="" class="img-fluid img-center">
                            @endif
                        </div>

                        <div class="post-view__content">
                            {!! $post->content !!}
                        </div>

                        <p class="post-view__date">
                            @if ($post->created_at->diffInDays(today()) > 7)
                                le {{ $post->created_at->locale('fr_FR')->isoFormat('LL') }}
                            @else
                                {{ $post->created_at->locale('fr')->diffForHumans() }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    @include('posts._sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
