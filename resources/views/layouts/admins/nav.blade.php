<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-white" href="{{ route('dashboard') }}">Accueil</a>
                </li>
                @if(request()->routeIs('mariages.*'))
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Mariages</li>
                @elseif(request()->routeIs('epoux.*'))
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Époux</li>
                @elseif(request()->routeIs('epouses.*'))
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Épouses</li>
                @elseif(request()->routeIs('ayants-droit.*'))
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Ayants droit</li>
                @elseif(request()->routeIs('regimes.*'))
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Régimes matrimoniaux</li>
                @elseif(request()->routeIs('status.*'))
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Statuts</li>
                @elseif(request()->routeIs('profile.*'))
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profil</li>
                @endif
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">
                @if(request()->routeIs('dashboard'))
                    Tableau de bord
                @elseif(request()->routeIs('mariages.*'))
                    Gestion des Mariages
                @elseif(request()->routeIs('epoux.*'))
                    Gestion des Époux
                @elseif(request()->routeIs('epouses.*'))
                    Gestion des Épouses
                @elseif(request()->routeIs('ayants-droit.*'))
                    Gestion des Ayants droit
                @elseif(request()->routeIs('regimes.*'))
                    Gestion des Régimes matrimoniaux
                @elseif(request()->routeIs('status.*'))
                    Gestion des Statuts
                @elseif(request()->routeIs('profile.*'))
                    Gestion du Profil
                @endif
            </h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Rechercher...">
                </div>
            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('profile.edit') }}" class="nav-link text-white font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="{{ asset('assets/img/team-2.jpg') }}" class="avatar avatar-sm me-3">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Nouveau mariage</span> enregistré
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>
                                            Il y a 13 minutes
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link text-white font-weight-bold px-0 border-0 bg-transparent">
                            <i class="fa fa-sign-out-alt me-sm-1"></i>
                            <span class="d-sm-inline d-none">Déconnexion</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
