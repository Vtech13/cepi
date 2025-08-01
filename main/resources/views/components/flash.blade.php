@if (session('success'))
    <div class="flash-message" id="flashMessage">
        <div class="container">
            <div class="flash-message__alert flash-message__alert--success flash-message__alert--button">
                <p>{!! session('success') !!}</p>
                <button onclick="this.parentNode.parentNode.parentElement.remove()">
                    <span class="icon icon-close"></span>
                </button>
            </div>
        </div>
    </div>
@endif

@if (session('warning'))
    <div class="flash-message" id="flashMessage">
        <div class="container">
            <div class="flash-message__alert flash-message__alert--warning flash-message__alert--button">
                <p>{!! session('warning') !!}</p>
                <button onclick="this.parentNode.parentElement.remove()">
                    <span class="icon icon-close"></span>
                </button>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="flash-message" id="flashMessage">
        <div class="container">
            <div class="flash-message__alert flash-message__alert--error flash-message__alert--button">
                <p>{!! session('error') !!}</p>
                <button onclick="this.parentNode.parentElement.remove()">
                    <span class="icon icon-close"></span>
                </button>
            </div>
        </div>
    </div>
@endif
