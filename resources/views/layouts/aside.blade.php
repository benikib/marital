<aside
class="fixed inset-y-0 left-0 w-64 bg-gray-900 border-r border-gray-800 shadow-xl rounded-r-2xl p-4 overflow-y-auto">

    <!-- LOGO -->
    <div class="flex items-center space-x-3 px-4 py-4">
        {{-- <x-application-logo class="h-8 w-auto text-indigo-500" /> --}}
        <span class="text-white font-bold text-lg">Marital </span>
    </div>

    <hr class="border-gray-800 my-2">

    <!-- MENU VERTICAL -->
    <ul class="space-y-2">

        <!-- SECTION : Navigation principale -->
        <li class="text-xs text-gray-400 uppercase px-4 pt-4 pb-2">
            Navigation
        </li>

        <!-- Dashboard -->
    
    @if(Auth::check() && Auth::user()->hasRole('superAdmin')) 
        <li>
            <a href="{{ route('dashboard.superAdmin') }}"
               class="sidebar-item {{ request()->routeIs('dashboard.superAdmin') ? 'active' : '' }}">
                <span>🏠</span>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- SECTION : Gestion -->
        <li class="text-xs text-gray-400 uppercase px-4 pt-4 pb-2">
            Gestion
        </li>

        <!-- Mariages -->
        <li>
            <a href="{{ route('mariages.index') }}"
               class="sidebar-item {{ request()->routeIs('mariages.*') ? 'active' : '' }}">
                <span>💍</span>
                <span>Mariages</span>
            </a>
        </li>

        <!-- Personnes -->
        <li>
            <a href="{{ route('personnes.index') }}"
               class="sidebar-item {{ request()->routeIs('personnes.*') ? 'active' : '' }}">
                <span>👤</span>
                <span>Personnes</span>
            </a>
        </li>

        <!-- Entités -->
        <li>
            <a href="{{ route('entites.index') }}"
               class="sidebar-item {{ request()->routeIs('entites.*') ? 'active' : '' }}">
                <span>🏢</span>
                <span>Entités</span>
            </a>
        </li>
        {{-- <-- SECTION : Gestion administrative --> --}}
        <li class="text-xs text-gray-400 uppercase px-4 pt-4 pb-2">
            Administration
        </li>   
        <!-- users -->
        <li>
            <a href="{{ route('users.index') }}"
               class="sidebar-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <span>👥</span>
                <span>Utilisateurs</span>
            </a>
        </li>

        <li>
            <a href="{{ route('roles.index') }}"
               class="sidebar-item {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <span>🔐</span>
                <span>Rôles</span>
            </a>
        </li>
        {{-- contrat --}}
        <li>
            <a href="{{ route('contrats.index') }}"
               class="sidebar-item {{ request()->routeIs('contrats.*') ? 'active' : '' }}">
                <span>📄</span>
                <span>Contrats</span>
            </a>
        </li>
        {{-- status --}}
        <li>
            <a href="{{ route('statuts.index') }}"
               class="sidebar-item {{ request()->routeIs('statuts.*') ? 'active' : '' }}">
                <span>📊</span>
                <span>Statuts</span>
            </a>
        </li>
    
    @endif
    @if(Auth::check() && Auth::user()->hasRole('agent')) 
        <li>
            <a href="{{ route('dashboard') }}"
               class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span>🏛</span>
                <span>Dashboard</span>
            </a>
        </li>
            <li>
                <a href="{{ route('mariages.index') }}"
                class="sidebar-item {{ request()->routeIs('mariages.*') ? 'active' : '' }}">
                    <span>attestation </span>
                    <span>Mariages</span>
                </a>
            </li>

            <li>
                <a href="{{ route('personnes.index') }}"
                class="sidebar-item {{ request()->routeIs('personnes.*') ? 'active' : '' }}">
                    <span>👤</span>
                    <span>Personnes</span>
                </a>
            </li>
    
    @endif

        <!-- SECTION : Compte -->
        <li class="text-xs text-gray-400 uppercase px-4 pt-6 pb-2">
            Compte
        </li>

        <!-- Profil -->
        <li>
            <a href="{{ route('profile.edit') }}"
               class="sidebar-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <span>⚙️</span>
                <span>Profil</span>
            </a>
        </li>

        <!-- Déconnexion -->
        <li>
            <button onclick="document.getElementById('logoutModal').showModal();"
                class="sidebar-item w-full text-left">
                <span>🚪</span>
                <span>Déconnexion</span>
            </button>
        </li>

    </ul>

</aside>

<!-- MODAL LOGOUT -->
<dialog id="logoutModal" class="rounded-2xl p-0 w-full max-w-md bg-white shadow-xl">
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <div class="bg-red-600 text-white p-4 rounded-t-2xl flex justify-between items-center">
            <span class="font-semibold">Confirmation de déconnexion</span>
            <button type="button" onclick="logoutModal.close()" class="hover:bg-red-700 rounded-full p-1 transition">
                ✕
            </button>
        </div>

        <div class="p-6 text-gray-700">
            <p>Voulez-vous vraiment vous déconnecter ?</p>
            <p class="text-sm text-gray-500 mt-2">Vous devrez vous reconnecter pour accéder à votre compte.</p>
        </div>

        <div class="flex justify-end gap-2 p-4 bg-gray-100 rounded-b-2xl">
            <button type="button" onclick="logoutModal.close()" 
                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg transition">
                Annuler
            </button>
            <button type="submit" 
                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                Déconnexion
            </button>
        </div>
    </form>
</dialog>

<!-- CSS supplémentaires (à mettre dans votre fichier CSS) -->
<style>
    .sidebar-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.625rem 1rem;
        border-radius: 0.5rem;
        color: #d1d5db;
        transition: all 0.2s ease;
        font-size: 0.875rem;
    }

    .sidebar-item:hover {
        background-color: #374151;
        color: white;
    }

    .sidebar-item.active {
        background-color: #4f46e5;
        color: white;
    }

    .sidebar-item span:first-child {
        font-size: 1.25rem;
    }

    dialog::backdrop {
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
    }
</style>