<header class="header">
    <div class="container">
        <div class="header__container">
            <div class="header__logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid">
                </a>
            </div>
            <div class="header__menu" id="container-nav">
                <div class="nav-icon" id="icon-nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <nav class="header__navigation" id="nav-links">
                    <a href="{{ route('home') }}"
                       class="{{ isset($class_body) && strpos($class_body, 'home') !== false ? 'active' : '' }}">
                        Accueil
                    </a>
                    <a href="{{ route('cabinet') }}"
                       class="{{ isset($class_body) && strpos($class_body, 'cabinet') !== false ? 'active' : '' }}">
                        Clinique CEPI
                    </a>
                    <div class="dropdown">
                        <a href="#"
                           class="dropdown__button {{ isset($class_body) && strpos($class_body, 'nos-soins') !== false ? 'active' : '' }}">
                            Soins
                            <x-icon-svg name="caret-down"/>
                        </a>
                        <div class="dropdown__content">
                            <a href="{{ route('chirurgie-buccale') }}"
                               class="dropdown__link {{ isset($class_body) && strpos($class_body, 'chirurgie-buccale') !== false ? 'active' : '' }}">
                                Chirurgie buccale
                            </a>
                            <a href="{{ route('esthetique-dentaire') }}"
                               class="dropdown__link {{ isset($class_body) && strpos($class_body, 'esthetique-dentaire') !== false ? 'active' : '' }}">
                                Esthétique du sourire
                            </a>
                            <a href="{{ route('endodontie') }}"
                               class="dropdown__link {{ isset($class_body) && strpos($class_body, 'endodontie') !== false ? 'active' : '' }}">
                                Endodontie
                            </a>
                            <a href="{{ route('parodontologie') }}"
                               class="dropdown__link {{ isset($class_body) && strpos($class_body, 'parodontologie') !== false ? 'active' : '' }}">
                                Parodontologie
                            </a>
                            <a href="{{ route('implantologie') }}"
                               class="dropdown__link {{ isset($class_body) && strpos($class_body, 'implantologie') !== false ? 'active' : '' }}">
                                Implantologie
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('conseils-patients') }}"
                       class="{{ isset($class_body) && strpos($class_body, 'conseils-patients') !== false ? 'active' : '' }}">
                        Espace patients
                    </a>
                    <a href="{{ route('videos-utiles') }}"
                       class="{{ isset($class_body) && strpos($class_body, 'videos-utiles') !== false ? 'active' : '' }}">
                        Vidéos utiles
                    </a>
                    <a href="{{ route('espaces-praticiens') }}"
                       class="{{ isset($class_body) && strpos($class_body, 'espaces-praticiens') !== false ? 'active' : '' }}">
                        Espace correspondants
                    </a>
                    <a href="{{ route('contact') }}"
                       class="{{ isset($class_body) && strpos($class_body, 'contact') !== false ? 'active' : '' }}">
                        Nous contacter
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>
