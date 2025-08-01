<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-asc">
                <div class="header__top-left">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-asc col-jse">
                <nav class="header__top-right">
                    @if (\Illuminate\Support\Facades\Auth::user())
                        @if (Auth::user()->isAdmin() || Auth::user()->isSuAdmin())
                            <a href="{{ route('admin.confreres') }}"
                               class="{{ !empty($active) && strpos($active, 'confreres') !== false ? 'active' : '' }}">
                                Confrères
                            </a>
                            <a href="{{ route('admin.patients.index') }}"
                               class="{{ !empty($active) && strpos($active, 'patients') !== false ? 'active' : '' }}">
                                Patients
                            </a>
                            <a href="{{ route('admin.messages.index') }}"
                               class="{{ !empty($active) && strpos($active, 'messages') !== false ? 'active' : '' }}">
                                Messages
                            </a>
                        @endif
                        @if (Auth::user()->isConfrere())
                            <!-- <a href="{{ route('user.users') }}"
                               class="{{ !empty($active) && strpos($active, 'user') !== false ? 'active' : '' }}">
                                Comptes rendus
                            </a> -->
                            <a href="{{ route('user.patients.index') }}"
                               class="{{ !empty($active) && strpos($active, 'patients') !== false ? 'active' : '' }}">
                                Patients
                            </a>
                            <a href="{{ route('user.messages.index') }}"
                               class="{{ !empty($active) && strpos($active, 'messages') !== false ? 'active' : '' }}">
                                Messages
                            </a>
                        @endif

                        <div class="header__top-right--user dropdown col-asc">
                            <p class="dropdown__button">{{ \Illuminate\Support\Facades\Auth::user()->iconLetter }}</p>
                            <div class="dropdown__content">
                                <a href="{{ route('logout') }}" class="dropdown__link">Se déconnecter</a>
                            </div>
                        </div>
                    @endif
                </nav>
            </div>
        </div>
    </div>
</header>
