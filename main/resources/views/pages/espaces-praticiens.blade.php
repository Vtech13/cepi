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
                <div class="block-text__content t-justify">
                    {!! $blocks['main_title']->content !!}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-4 col-jsc">
                    {!! $blocks['outils']->content !!}
                </div>
                <div class="col-xs-12 col-sm-4 col-jsc">
                    {!! $blocks['formation']->content !!}
                </div>
                <div class="col-xs-12 col-sm-4 col-jsc">
                    {!! $blocks['patients']->content !!}
                </div>
            </div>
        </div>
    </section>

    <section class="section section--pad-t">
        <div class="container">
            <div class="t-center">
                <a href="{{ route('admin.dashboard') }}" class="btn btn--action">
                    Acceder à la platforme confrère
                </a>
            </div>
        </div>
    </section>
@endsection
