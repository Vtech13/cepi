@extends('layouts.app')

@section('content')
    <section class="section section--top bg-img">
        <div class="container">
            <h1 class="title title--h1">
                {{ $blocks['main_title']->title }}
            </h1>
        </div>
    </section>

    <section class="section section__esthetique" id="esthetique">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title block-text__title--mt-0">
                    {{ $blocks['esthetique']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['esthetique']->content !!}
                </div>
            </div>
        </div>
    </section>

    <hr class="line">

    <section class="section section__parodontologie" id="parodontologie">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title block-text__title--mt-0">
                    {{ $blocks['parodontologie']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['parodontologie']->content !!}
                </div>
            </div>

            <div class="block-text">
                <p class="block-text__title block-text__title--small">
                    {{ $blocks['paro_consultation']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['paro_consultation']->content !!}
                </div>
            </div>

            <div class="block-text">
                <p class="block-text__title block-text__title--small">
                    {{ $blocks['examen_1']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['examen_1']->content !!}
                </div>
            </div>
            <div class="block-text__content mt-30">
                {!! $blocks['examen_2']->content !!}
            </div>
        </div>
    </section>

    <hr class="line">

    <section class="section section__implantodologie" id="implantodologie">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title block-text__title--mt-0">
                    {{ $blocks['implantologie']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['implantologie']->content !!}
                    <p class="ff-hand volonte">
                        {{ $blocks['implantologie_1']->title }}
                    </p>
                </div>
            </div>

            <div class="block-text">
                <p class="block-text__title block-text__title--small">
                    {{ $blocks['implant_consultation']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['implant_consultation']->content !!}
                    <p class="block-text__title block-text__title--small">
                        {{ $blocks['implant_examen']->title }}
                    </p>
                    {!! $blocks['implant_examen']->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection
