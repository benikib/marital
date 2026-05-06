<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nationalités</h2>
            <a href="{{ route('nationalites.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">Nouvelle nationalité</a>
        </div>
    </x-slot>

    <div class="p-6 space-y-6">
        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="text-sm text-blue-600 font-medium">Total Nationalités</div>
                <div class="text-2xl font-bold text-blue-900">{{ $stats['total'] }}</div>
            </div>
            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
                <div class="text-sm text-indigo-600 font-medium">Résultats filtrés</div>
                <div class="text-2xl font-bold text-indigo-900">{{ $stats['resultats_filtres'] }}</div>
            </div>
        </div>

        <div class="  ">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">{{ session('success') }}</div>
            @endif

            <!-- Recherche simple -->
            <form method="GET" class="mb-6 flex flex-col md:flex-row gap-3 items-start md:items-end">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche rapide</label>
                    <input id="search" type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Rechercher..." class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">Rechercher</button>
                </div>
            </form>

            <!-- Recherche avancée -->
            <details class="mb-6 bg-gray-50 border border-gray-300 rounded-lg p-4 cursor-pointer">
                <summary class="font-semibold text-gray-700 hover:text-gray-900">⚙️ Recherche avancée</summary>
                <form method="GET" class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Champ de recherche simple (caché dans les filtres avancés) -->
                    <input type="hidden" name="search" value="{{ request('search') }}" />

                    <!-- Personne -->
                    <div>
                        <label for="personne_id" class="block text-sm font-medium text-gray-700 mb-1">Personne</label>
                        <select id="personne_id" name="personne_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Toutes les personnes --</option>
                            @foreach($personnes as $personne)
                                <option value="{{ $personne->id }}" @selected(request('personne_id') == $personne->id)>
                                    {{ $personne->nom }} {{ $personne->prenom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Résidence -->
                    <div>
                        <label for="residence" class="block text-sm font-medium text-gray-700 mb-1">Résidence</label>
                        <input id="residence" type="text" name="residence" value="{{ request('residence') }}" placeholder="Ex: Kinshasa" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <!-- Boutons -->
                    <div class="flex gap-2 items-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">Filtrer</button>
                        <a href="{{ route('nationalites.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-800 rounded-md">Réinitialiser</a>
                    </div>
                </form>
            </details>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Noms , lien et dates de naissance</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Residence</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entité d'enregistrement</th>

                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($nationalites as $nationalite)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $nationalite->personne->nom ?? 'N/A' }} {{ $nationalite->personne->postnom ?? ' -' }} {{ $nationalite->personne->prenom ?? '-' }} {{ $nationalite->personne->lieu_naissance ?? " -" }}{{ $nationalite->personne->date_naissance->format('d/m/Y') ?? ' -' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $nationalite->residence ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $nationalite->entite->nom  ?? 'N/A' }} ({{ ($nationalite->entite->type  ?? 'N/A') }}) </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('nationalites.show', $nationalite) }}" class="text-blue-600 hover:text-blue-900">Voir </a>
                                            <a href="{{ route('nationalites.edit', $nationalite) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form action="{{ route('nationalites.destroy', $nationalite) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer cette nationalité ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $nationalites->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
