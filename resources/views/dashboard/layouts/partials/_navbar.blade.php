
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard.home.index') }}" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('profile.show') }}" class="nav-link" target="_blank">Settings</a>
    </li>
</ul>

<!-- Right navbar links -->
<ul class="ml-auto navbar-nav">
    {{-- Select language --}}
    <li>
        <div class="dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-flag"></i>
            </a>

            <div class="dropdown-menu">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>

    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-link" type="submit">
                {{ __('Logout') }}
            </button>
        </form>
    </li>


</ul>
