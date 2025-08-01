@extends('layouts.app')

@section('content')
    <section class="section section--top" id="mapid"></section>

    <section class="section">
        <div class="container">
            <p class="block-text__title ff-hand">Contactez-nous</p>

            <form action="{{ route('contact.store') }}" method="post" class="form" enctype="multipart/form-data">
                @csrf

                <div class="grid col-2">
                    <x-form.input name="lastname" label="Nom *" placeholder="Entrez votre nom" required/>
                    <x-form.input name="firstname" label="Prénom *" placeholder="Entrez votre prénom" required/>
                    <x-form.input name="date_of_birth" label="Date de naissance *"
                                  placeholder="Entrez votre date de naissance (24/01/1990)" required/>
                    <x-form.input name="address" label="Adresse *" placeholder="Entrez votre adresse postal" required/>
                    <x-form.input name="postal_code" label="Code postal *" placeholder="Entrez votre code postal"
                                  required/>
                    <x-form.input name="city" label="Ville *" placeholder="Entrez votre ville" required/>
                    <div>
                        <x-form.input type="email" name="email" label="Email *" placeholder="Entrez votre email"
                                      required/>
                        <div class="prenom_form">
                            <input type="text" name="prenom" placeholder="Ne pas remplir ce champs">
                        </div>
                    </div>

                    <x-form.input name="phone" label="Téléphone *" placeholder="Entrez votre numéro" required/>
                    <x-form.input name="number_security_social" label="Numéro de sécurité sociale *"
                                  placeholder="Entrez votre numéro de sécurité social" required/>

                    <x-form.select name="mutuelle" label="Mutuelle *" required>
                        <option value="">Sélectionnez votre mutuelle</option>
                        <option value="cmu" @if (old('mutuelle') === 'cmu') selected @endif>
                            CMU
                        </option>
                        <option value="css" @if (old('mutuelle') === 'css') selected @endif>
                            CSS
                        </option>
                        <option value="acs" @if (old('mutuelle') === 'acs') selected @endif>
                            ACS
                        </option>
                        <option value="autre" @if (old('mutuelle') === 'autre') selected @endif>
                            Autre
                        </option>
                    </x-form.select>

                    <x-form.select name="motif" label="Motif *" required>
                        <option value="">Sélectionnez votre motif</option>
                        <option value="chirurgie_buccale" @if (old('motif') === 'chirurgie_buccale') selected @endif>
                            Chirurgie buccale
                        </option>
                        <option value="esthetique_dentaire"
                                @if (old('motif') === 'esthetique_dentaire') selected @endif>
                            Esthétique dentaire
                        </option>
                        <option value="endodontie" @if (old('motif') === 'endodontie') selected @endif>
                            Endodontie
                        </option>
                        <option value="parodontologie" @if (old('motif') === 'parodontologie') selected @endif>
                            Parodontologie
                        </option>
                        <option value="implantologie" @if (old('motif') === 'implantologie') selected @endif>
                            Implantologie
                        </option>
                    </x-form.select>

                    <x-form.input name="name_dentist" label="Nom de votre chirurgien-dentiste *"
                                  placeholder="Entrez le nom de votre chirurgien-dentiste" required/>

                    <x-form.input type="file" name="file" label="Courrier ou ordonnance de votre chirurgien dentiste"/>
                    <x-form.input type="file" name="file_pano_dentaire" label="Panoramique dentaire"/>
                </div>

                <x-form.textarea name="message" label="Message *" placeholder="Entrez votre message" required/>

                <button type="submit" class="form__submit">Envoyer</button>
            </form>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
@endsection
