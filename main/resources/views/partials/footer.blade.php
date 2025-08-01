<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-asc">
                <ul>
                    <li>
                        <a href="{{ route('mentions-legales') }}">Mentions légales</a>
                    </li>
                    <li>
                        <a href="https://www.ordre-chirurgiens-dentistes.fr/" target="_blank">Conseil de l'ordre</a>
                    </li>
                    <li>
                        <a href="https://www.ordre-chirurgiens-dentistes.fr/annuaire/" target="_blank">Annuaire du dentaire</a>
                    </li>
                    <li>
                        <a href="{{ asset('files/charte-communication-chirurgien-dentiste.pdf') }}" target="_blank">Charte communication du chirurgien-dentiste</a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-asc col-jse">
                <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid footer__logo">
            </div>
        </div>
    </div>

    <div class="footer__end">
        <p class="t-center">
            {{ date('Y') }} &copy; {{ config('app.name_company') }}
        </p>
    </div>
</footer>
