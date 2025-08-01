@extends('layouts.app')

@section('content')
    <section class="section section--top bg-img">
        <div class="container">
            <p class="title title--h1">
                {{ $blocks['main_title']->title }}
            </p>
        </div>
    </section>

    <section class="section section__1">
        <div class="container">
            <div class="block-text">
                <div class="block-text__content">
                    {!! $blocks['main_title']->content !!}
                </div>
            </div>

            <div class="block-text">
                <p class="block-text__title block-text__title--small">
                    {{ $blocks['proprieter_hebergement']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['proprieter_hebergement']->content !!}
                </div>
            </div>

            <div class="block-text">
                <p class="block-text__title block-text__title--small">
                    {{ $blocks['propriete_intellectuelle']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['propriete_intellectuelle']->content !!}
                </div>
            </div>

            <div class="block-text">
                <p class="block-text__title block-text__title--small">
                    {{ $blocks['confidentialite']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['confidentialite']->content !!}
                </div>
            </div>

            <div class="block-text">
                <p class="block-text__title block-text__title--small">
                    {{ $blocks['liens_publicites']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['liens_publicites']->content !!}
                </div>
            </div>

            <div class="block-text">
                <p class="block-text__title block-text__title--small">
                    {{ $blocks['responsabilite']->title }}
                </p>
                <div class="block-text__content">
                    {!! $blocks['responsabilite']->content !!}
                </div>
            </div>
        </div>
    </section>

    <section class="section banniere-ordre">
        <div class="container">
            <div
                style="border:#6d2077 solid 3px;color: rgb(103, 103, 103);padding: 2%;background-color:#fff;text-align:left;min-height:550px;">

                <strong>DOCTEUR : </strong> <br><br>
                <div style="width:40px; float:left; padding-right:10px;"><img
                        src="http://www.ordre-chirurgiens-dentistes.fr/banniere/images/LOGO_ORDRE_40.png" width="40"
                        height="41" alt=""></div>
                <div style="padding-left:50px;">Nom : PAGBE NDOBO<br>
                    Prénom : Pauline<br>
                    N° RPPS : 10 100 415 420
                </div>
                <br><br>
                Les informations énoncées ci-dessous relèvent de la responsabilité pleine de ce praticien
                <br>
                <div class="spec"
                     style="border: 1px solid rgb(0, 0, 0); margin: 5px 0px; padding: 10px; text-align: left; background-color: rgba(0, 0, 0, 0.1); color: rgb(255, 255, 255);">
                    <strong>SPÉCIALISTE QUALIFIÉ(E)</strong> en : <br><br>
                    <input type="checkbox" id="specialiste1" disabled="">
                    <label for="specialiste1" style="margin-left: 5px;">Chirurgie orale</label>
                    <br>
                    <input type="checkbox" id="specialiste2" disabled="">
                    <label for="specialiste2" style="margin-left: 5px;">Médecine bucco-dentaire</label>
                    <br>
                    <input type="checkbox" id="specialiste3" disabled="">
                    <label for="specialiste3" style="margin-left: 5px;">Orthopédie dento-faciale | Orthodontie</label>
                    <br><br>
                    Ces spécialités sont reconnues par Le Conseil national de l’ordre.
                </div>
                <div class="omni"
                     style="border: 1px solid rgb(0, 0, 0); margin: 5px 0px; padding: 10px; text-align: left; background-color: rgba(0, 0, 0, 0); color: rgb(103, 103, 103);">
                    <strong>OMNIPRATICIEN</strong><br>
                    Orientations professionnelles des disciplines odontologiques :<br><br>
                    <input type="checkbox" id="omni1" disabled="">
                    <label for="omni1" style="margin-left: 5px;">Omnipratique (réalisation de l’ensemble des orientations)</label>
                    <br>
                    <input type="checkbox" id="omni2" disabled="">
                    <label for="omni2" style="margin-left: 5px;">Endodontie</label>
                    <br>
                    <input type="checkbox" id="omni3" checked disabled="">
                    <label for="omni3" style="margin-left: 5px;">Odontologie chirurgicale</label>
                    <br>
                    <input type="checkbox" id="omni4" disabled="">
                    <label for="omni4" style="margin-left: 5px;">Odontologie conservatrice</label>
                    <br>
                    <input type="checkbox" id="omni5" disabled="">
                    <label for="omni5" style="margin-left: 5px;">Odontologie pédiatrique</label>
                    <br>
                    <input type="checkbox" id="omni6" disabled="">
                    <label for="omni6" style="margin-left: 5px;">Orthodontie</label>
                    <br>
                    <input type="checkbox" id="omni7" checked disabled="">
                    <label for="omni7" style="margin-left: 5px;">Parodontologie</label>
                    <br>
                    <input type="checkbox" id="omni8" disabled="">
                    <label for="omni8" style="margin-left: 5px;">Prothèse</label>
                    <br>
                    <input type="checkbox" id="omni9" disabled="">
                    <label for="omni9" style="margin-left: 5px;">Traitement des dysfonctions oro-faciales</label>
                    <br><br>
                    <p class="just">Les orientations professionnelles ne sont ni une spécialité reconnue, ni une compétence.
                        Il s’agit d’une pratique personnelle déclarative non attestée par Le Conseil national de
                        l’ordre.</p>
                </div>
            </div>
        </div>
    </section>

@endsection
