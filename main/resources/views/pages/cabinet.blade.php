@extends('layouts.app')

@section('content')
    <section class="section section--top bg-img">
        <div class="container">
            <h1 class="title title--h1">
                {{ $blocks['main_title']->title }}
            </h1>
        </div>
    </section>

    <section class="section section__1">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title">
                    {{ $blocks['intro']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['intro']->content !!}
                </div>
            </div>

            <div class="block-text">
                <p class="block-text__title title-before-arrived">
                    {{ $blocks['arrive_title']->title }}
                </p>
                <div class="block-text__content block-before-arrived">
                    <div>
                        <a href="{{ route('contact') }}">
                            <x-icon-svg name="rdv"/>
                            <p>Prise de RDV</p>
                        </a>
                    </div>
                    <div>
                        <x-icon-svg name="rdv-email"/>
                        <p>Confirmation par mail</p>
                    </div>
                    <div>
                        <a href="{{ asset('files/qm-adulte.pdf') }}" target="_blank" rel="noopener">
                            <x-icon-svg name="questionnaire"/>
                            <p>Remplir Questionnaire médical</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="block-text__title ff-hand oscar">
                <p>
                    {!! $blocks['oscar_wilde']->content !!}
                </p>
            </div>
        </div>
    </section>

    <hr class="line">

    <section class="section section--equipe" id="notre-equipe">
        <div class="container">
            <p class="title t-center">
                {{ $blocks['equipe_title']->title }}
            </p>

            <div class="teams">
                <x-box-equipe :block="$blocks['equipe_1']"/>
                <x-box-equipe :block="$blocks['equipe_2']"/>
                <x-box-equipe :block="$blocks['equipe_3']"/>
                <x-box-equipe :block="$blocks['equipe_4']"/>
                <x-box-equipe :block="$blocks['equipe_5']"/>
                <x-box-equipe :block="$blocks['equipe_6']"/>
                <x-box-equipe :block="$blocks['equipe_7']"/>
                <x-box-equipe :block="$blocks['equipe_8']"/>
                <x-box-equipe :block="$blocks['equipe_9']"/>
            </div>
        </div>
    </section>

    @if (!empty($blocks['laboratoire']) || !empty($blocks['laboratoire_2']))
        <hr class="line">
    @endif

    <section class="section section--labo">
        <div class="container">
            <div class="block-text">
                <p class="block-text__title">
                    {{ $blocks['laboratoire']->title }}
                </p>
                <div class="block-text__content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-jsc">
                            {!! $blocks['laboratoire']->content !!}
                        </div>
                        <div class="col-xs-12 col-sm-6 col-jsc">
                            {!! $blocks['laboratoire_2']->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
