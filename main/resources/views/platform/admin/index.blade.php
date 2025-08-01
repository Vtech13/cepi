<x-layouts.app :link-active="$link_active" :class-body="$class_body">
    <x-section>
        <h1>Dashboard</h1>

        <p class="mb-30">
            Bienvenue sur votre platforme CliniqueCepi, ici vous pouvez retrouver des informations sur son
            fonctionnement.
        </p>

        <div class="tab">
            <div class="tab__links">
                <div>
                    <button class="tab__link" data-id="confrere">Confrère</button>
                </div>
            </div>
        </div>

        <div class="block-content">
            <div id="confrere" class="tab__content">
                <div class="info box-info">
                    <div class="info__text box-info__value">
                        <p>
                            Pour ajouter un confrère, sur le menu en haut à droite cliquer sur "Confrère" puis sur le
                            bouton "Ajouter un confrère".
                        </p>
                    </div>
                    <div class="info__image">
                        <img src="{{ asset('img/dashboard/confrere/add-confrere-1.jpg') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="info box-info">
                    <div class="info__text box-info__value">
                        <p>
                            Sur la page d'ajout d'un confrère, remplir le prénom, nom et email du confrère (l'email ne
                            doit pas être déjà utilisé par un autre confrère).
                        </p>
                        <p>
                            Vous pouvez ici lui déposer dans son espace des documents que lui seul aura accès.
                        </p>
                        <p>
                            Lorsque vous cliquez sur le bouton "Enregistrer" <strong>un email sera envoyé</strong> au
                            nouveau confrère pour qu'il puisse créer son mot de passe et activer son compte. <br>
                            Si le confrère existe deja il sera notifié par email lors d'ajout de documents dans son
                            espace.
                        </p>
                    </div>
                    <div class="info__image">
                        <img src="{{ asset('img/dashboard/confrere/add-confrere-2.jpg') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </x-section>
</x-layouts.app>
