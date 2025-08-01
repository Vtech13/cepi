@extends('layouts.app')

@section('content')
    <section class="section section--top bg-img">
        <div class="container">
            <h1 class="title title--h1">
                {{ $blocks['main_title']->title }}
            </h1>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title block-text__title--mt-0">
                    {{ $blocks['block_1']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['block_1']->content !!}
                    <p class="ff-hand volonte">
                        {{ $blocks['block_2']->title }}
                    </p>
                </div>
            </div>

            <div class="block-text">
                <p class="block-text__title block-text__title--small">
                    {{ $blocks['block_3']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['block_3']->content !!}
                    <p class="block-text__title block-text__title--small">
                        {{ $blocks['block_4']->title }}
                    </p>
                    {!! $blocks['block_4']->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection
