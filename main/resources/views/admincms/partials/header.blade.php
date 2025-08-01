<header class="header">
    <div class="header__top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6">
                    <a href="{{ route('office.dashboard') }}" class="d_block">
                        <div class="header__logo">
                            <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid">
                        </div>
                    </a>
                </div>
                <div class="col-xs-6">
                    <div class="header__user">
                        <div class="dropdown">
                            <div class="dropdown__button">
                                {{ Auth::user()->firstname }}
                            </div>
                            <div class="dropdown__content">
                                <a href="{{ route('office.logout') }}" class="dropdown__link">
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header__nav t-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <div class="header__nav-item">
                        <a href="{{ route('office.pages.index') }}" class="{{ isset($class_body) && strpos($class_body, 'pages') !== false ? 'active' : ''}}">
                            <span class="header__nav-name">Pages</span>
                        </a>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="header__nav-item">
                        <a href="{{ route('office.posts.index') }}" class="{{ isset($class_body) && strpos($class_body, 'posts') !== false ? 'active' : ''}}">
                            <span class="header__nav-name">Articles</span>
                        </a>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="header__nav-item">
                        <a href="{{ route('office.contacts.index') }}" class="{{ isset($class_body) && strpos($class_body, 'contacts') !== false ? 'active' : ''}}">
                            <span class="header__nav-name">Contacts</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
