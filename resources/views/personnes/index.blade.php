<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Personnes</h2>
            <a href="{{ route('personnes.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">Nouvelle personne</a>
        </div>
    </x-slot>

    <div class="p-6 space-y-6">
        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="text-sm text-blue-600 font-medium">Total Personnes</div>
                <div class="text-2xl font-bold text-blue-900">{{ $stats['total'] }}</div>
            </div>
            <div class="bg-cyan-50 border border-cyan-200 rounded-lg p-4">
                <div class="text-sm text-cyan-600 font-medium">Hommes</div>
                <div class="text-2xl font-bold text-cyan-900">{{ $stats['hommes'] }}</div>
            </div>
            <div class="bg-pink-50 border border-pink-200 rounded-lg p-4">
                <div class="text-sm text-pink-600 font-medium">Femmes</div>
                <div class="text-2xl font-bold text-pink-900">{{ $stats['femmes'] }}</div>
            </div>
        </div>

        <!-- Message de résultats filtrés -->
        @if(request('search') || request('sexe') || request('lieu') || request('date_debut') || request('date_fin'))
            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
                <p class="text-sm text-indigo-900">
                    <strong>Résultats filtrés :</strong> {{ $stats['resultats_filtres'] }} personne(s) 
                    @if($stats['resultats_filtres'] > 0)
                        ({{ $stats['hommes_filtres'] }} homme(s), {{ $stats['femmes_filtres'] }} femme(s))
                    @endif
                </p>
            </div>
        @endif

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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sexe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lieu de naissance</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de naissance</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entité d'enregistrement</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($personnes as $personne)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $personne->nom }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $personne->prenom }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $personne->sexe }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $personne->lieu_naissance }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $personne->date_naissance->format('d-m-Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $personne->entite->nom  ?? 'N/A' }} ({{ ($personne->entite->type  ?? 'N/A') }}) </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('personnes.show', $personne) }}" class="text-blue-600 hover:text-blue-900">Voir </a>
                                            <a href="{{ route('personnes.edit', $personne) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            {{-- <form action="{{ route('personnes.destroy', $personne) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer cette personne ?')">Supprimer</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $personnes->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
