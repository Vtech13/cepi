@if (session('success'))
    <div class="flash-message" onclick="this.classList.add('d_none');">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('warning'))
    <div class="flash-message" onclick="this.classList.add('d_none');">
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class="flash-message" onclick="this.classList.add('d_none');">
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    </div>
@endif
