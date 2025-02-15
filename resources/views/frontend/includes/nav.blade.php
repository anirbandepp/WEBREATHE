<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('modules.index') }}">WEBREATHE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('modules.index') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('modules.index') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('modules.create') ? 'active' : '' }}"
                        href="{{ route('modules.create') }}">
                        Add Module
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('modules.status') ? 'active' : '' }}"
                        href="{{ route('modules.status') }}">
                        Status
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
