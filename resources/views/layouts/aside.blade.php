<!-- Mobile Menu Button -->
<button id="mobileMenuButton" class="fixed top-4 left-4 z-50 md:hidden bg-gray-900 text-white p-2 rounded-lg shadow-lg">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<!-- Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300 md:hidden"></div>

<!-- Sidebar -->
<aside id="sidebar" 
    class="fixed inset-y-0 left-0 w-64 bg-gray-900 border-r border-gray-800 shadow-xl rounded-r-2xl p-4 overflow-y-auto transform transition-transform duration-300 ease-in-out z-50 
    -translate-x-full md:translate-x-0 md:relative md:z-auto">

    <!-- Mobile Close Button -->
    <button id="closeSidebarButton" class="absolute top-4 right-4 md:hidden text-gray-400 hover:text-white">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- LOGO -->
    <div class="flex items-center space-x-3 px-4 py-4">
        <span class="text-white font-bold text-lg">Marital</span>
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
        {{-- SECTION : Gestion administrative --}}
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
                    <span>📜</span>
                    <span>Certificat Mariages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('nationalites.index') }}"
                class="sidebar-item {{ request()->routeIs('nationalites.*') ? 'active' : '' }}">
                    <span>🌍</span>
                    <span>Attest Nationalités</span>
                </a>
            </li>
                <li>
                    <a href="{{ route('naissances.index') }}"
                    class="sidebar-item {{ request()->routeIs('naissances.*') ? 'active' : '' }}">
                        <span>👶</span>
                        <span>Attest Naissances</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('residences.index') }}"
                    class="sidebar-item {{ request()->routeIs('residences.*') ? 'active' : '' }}">
                        <span>🏠</span>
                        <span>Attest Résidences</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('veuvages.index') }}"
                    class="sidebar-item {{ request()->routeIs('veuvages.*') ? 'active' : '' }}">
                        <span>💔</span>
                        <span>Attest Veuvages</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('deces.index') }}"
                    class="sidebar-item {{ request()->routeIs('deces.*') ? 'active' : '' }}">
                        <span>⚰️</span>
                        <span>Attest Décès</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('celibats.index') }}"
                    class="sidebar-item {{ request()->routeIs('celibats.*') ? 'active' : '' }}">
                        <span>💑</span>
                        <span>Attest Célibats</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('inhumations.index') }}"
                    class="sidebar-item {{ request()->routeIs('inhumations.*') ? 'active' : '' }}">
                        <span>🪦</span>
                        <span>Attest Inhumations</span>
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

<!-- CSS supplémentaires -->
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

    /* Mobile menu transitions */
    @media (max-width: 768px) {
        .sidebar-item {
            padding: 0.75rem 1rem;
        }
    }
</style>

<!-- JavaScript for mobile menu -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const closeButton = document.getElementById('closeSidebarButton');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', openSidebar);
    }

    if (closeButton) {
        closeButton.addEventListener('click', closeSidebar);
    }

    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Close sidebar when clicking on a link (mobile only)
    const sidebarLinks = sidebar.querySelectorAll('a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 768) {
                closeSidebar();
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        } else {
            if (!sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.add('-translate-x-full');
            }
        }
    });
});
</script>