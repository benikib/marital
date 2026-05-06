@props(['stats' => null])

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="text-sm text-blue-600 font-medium">Total</div>
        <div class="text-2xl font-bold text-blue-900">{{ $stats['total'] ?? 0 }}</div>
    </div>
    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
        <div class="text-sm text-indigo-600 font-medium">Résultats filtrés</div>
        <div class="text-2xl font-bold text-indigo-900">{{ $stats['filtered'] ?? 0 }}</div>
    </div>
</div>

<form method="GET" class="mb-4 flex flex-col md:flex-row gap-3 items-start md:items-end">
    <div class="flex-1">
        <label for="search" class="sr-only">Recherche</label>
        <input id="search" type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Rechercher..." class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
    </div>
    <div class="flex gap-2">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">Rechercher</button>
        <a href="{{ url()->current() }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Réinitialiser</a>
    </div>
</form>

<details class="mb-6 bg-gray-50 border border-gray-300 rounded-lg p-4 cursor-pointer">
    <summary class="font-semibold text-gray-700 hover:text-gray-900">⚙️ Recherche avancée</summary>
    <p class="mt-3 text-sm text-gray-600">
        {{-- Utilisez plusieurs mots-clés pour rechercher sur les champs principaux. Vous pouvez combiner nom, description, lieu, date, entité, etc. --}}
        
    </p>
                    <form method="GET" class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Champ de recherche simple (caché dans les filtres avancés) -->
                    <input type="hidden" name="search" value="{{ request('search') }}" />

                    <!-- Sexe -->
                    <div>
                        <label for="sexe" class="block text-sm font-medium text-gray-700 mb-1">Sexe</label>
                        <select id="sexe" name="sexe" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Tous --</option>
                            <option value="M" @selected(request('sexe') === 'M')>Masculin</option>
                            <option value="F" @selected(request('sexe') === 'F')>Féminin</option>
                        </select>
                    </div>

                    <!-- Lieu de naissance -->
                    <div>
                        <label for="lieu" class="block text-sm font-medium text-gray-700 mb-1">Lieu de naissance</label>
                        <input id="lieu" type="text" name="lieu" value="{{ request('lieu') }}" placeholder="Ex: Kinshasa" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <!-- Date de naissance début -->
                    <div>
                        <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-1">Date naissance (à partir de)</label>
                        <input id="date_debut" type="date" name="date_debut" value="{{ request('date_debut') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <!-- Date de naissance fin -->
                    <div>
                        <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-1">Date naissance (jusqu'à)</label>
                        <input id="date_fin" type="date" name="date_fin" value="{{ request('date_fin') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <!-- Boutons -->
                    <div class="md:col-span-4 flex gap-2">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">Filtrer</button>
                        <a href="{{ route('personnes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 rounded-md">Réinitialiser</a>
                    </div>
                </form>
</details>
