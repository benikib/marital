<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-900 leading-tight">Divorces</h2>
                <p class="text-sm text-gray-500 mt-1">Gérez les actes de divorce avec une vue claire et organisée.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('divorces.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700">💔 Enregistrer un divorce</a>
                <a href="{{ route('divorces.index') }}" class="inline-flex items-center justify-center rounded-2xl bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200">↻ Rafraîchir</a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-4 xl:grid-cols-3">
            <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Total divorces</p>
                <p class="mt-4 text-3xl font-semibold text-red-600">{{ $stats['total'] ?? '0' }}</p>
            </section>
            <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Résultats filtrés</p>
                <p class="mt-4 text-3xl font-semibold text-indigo-600">{{ $stats['filtered'] ?? '0' }}</p>
            </section>
            <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Dernier acte</p>
                <p class="mt-4 text-3xl font-semibold text-gray-900">{{ optional($divorces->first())->num_acte ?? 'Aucun' }}</p>
            </section>
        </div>

        <div class="mt-8 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
            <form method="GET" class="grid gap-4 lg:grid-cols-4">
                <div>
                    <label for="search" class="text-sm font-medium text-gray-700">Recherche</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Époux, épouse, acte..."
                        class="mt-2 block w-full rounded-2xl border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>
                <div>
                    <label for="date" class="text-sm font-medium text-gray-700">Date divorce</label>
                    <input type="date" id="date" name="date" value="{{ request('date') }}"
                        class="mt-2 block w-full rounded-2xl border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>
                <div class="flex flex-col justify-end gap-3 lg:col-span-2 xl:col-span-1">
                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Filtrer</button>
                    <a href="{{ route('divorces.index') }}" class="inline-flex items-center justify-center rounded-2xl bg-gray-100 px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200">Réinitialiser</a>
                </div>
            </form>
        </div>

        <div class="mt-8 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table id="tableDivorces" class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider">Couple</th>
                            <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider">Date divorce</th>
                            <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider">Acte</th>
                            <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider">Entité</th>
                            <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($divorces as $divorce)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="font-semibold">{{ $divorce->mariage->epoux->nom ?? '-' }} {{ $divorce->mariage->epoux->prenom ?? '' }}</div>
                                    <div class="mt-1 text-gray-500">{{ $divorce->mariage->epouse->nom ?? '-' }} {{ $divorce->mariage->epouse->prenom ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ optional($divorce->date_divorce)->format('d/m/Y') ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $divorce->num_acte }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $divorce->entite->nom ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <a href="{{ route('divorces.show', $divorce) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                    <a href="{{ route('divorces.edit', $divorce) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">Aucun divorce trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-gray-100 bg-gray-50 px-6 py-4">
                {{ $divorces->links() }}
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        $('#tableDivorces').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            language: {
                search: "🔍 Rechercher :",
                lengthMenu: "Afficher _MENU_ éléments",
                info: "Affichage de _START_ à _END_ sur _TOTAL_",
                paginate: {
                    next: "Suivant",
                    previous: "Précédent"
                }
            }
        });
    });
    </script>
</x-app-layout>