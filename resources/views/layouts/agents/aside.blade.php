<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start ms-4 mt-4 h-100"
    id="sidenav-main">
    <div class="sidenav-header mt-3">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('agent.dashboard') }}">
            <img src="{{ asset('assets/img/logo.png') }}" width="26px" height="26px" class="navbar-brand-img h-100"
                alt="logo">
            <span class="ms-1 font-weight-bold">Agent Communal</span>
        </a>
    </div>
    <hr class="horizontal dark mt-3">
    <div class="collapse navbar-collapse w-auto h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav h-100">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Tableau de bord</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}"
                    href="{{ route('agent.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-tachometer-alt text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tableau de bord</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('agent.overviews') ? 'active' : '' }}"
                    href="{{ route('agent.overviews') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-chart-pie text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Vue d'ensemble</span>
                </a>
            </li> --}}

            <li class="nav-item mt-4">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Gestion des Mariages</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('agent.mariagescommunes.*') ? 'active' : '' }}"
                    href="{{ route('agent.mariagescommunes.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-ring text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Liste des Mariages</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('agent.mariagescommunes.create') ? 'active' : '' }}"
                    href="{{ route('agent.mariagescommunes.create') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-plus-circle text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Nouveau Mariage</span>
                </a>
            </li>

            {{-- <li class="nav-item mt-4">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Rapports</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('agent.rapports.mensuel') ? 'active' : '' }}"
                    href="{{ route('agent.rapports.mensuel') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-calendar-alt text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Rapport Mensuel</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('agent.rapports.annuel') ? 'active' : '' }}"
                    href="{{ route('agent.rapports.annuel') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-calendar text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Rapport Annuel</span>
                </a>
            </li> --}}

            <li class="nav-item mt-4">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Compte</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('agent.profile.*') ? 'active' : '' }}"
                    href="{{ route('agent.profile.edit') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-cog text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profil</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
