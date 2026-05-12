<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-900 leading-tight">Compositions familiales</h2>
                <p class="text-sm text-gray-500 mt-1">Consultez et gérez les actes de composition de famille.</p>
            </div>
            <a href="{{ route('composition_familiales.create') }}"
                class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                ➕ Nouvelle composition
            </a>
        </div>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider">Acte</th>
                            <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider">Couple</th>
                            <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider">Enfants</th>
                            <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider">Entité</th>
                            <th class="px-6 py-4 font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($compositions as $composition)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $composition->num_acte ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $composition->mariage->epoux->nom ?? '-' }} {{ $composition->mariage->epoux->prenom ?? '' }}
                                    &amp;
                                    {{ $composition->mariage->epouse->nom ?? '-' }} {{ $composition->mariage->epouse->prenom ?? '' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $composition->nombre_enfants ?? 0 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $composition->entite->nom ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('composition_familiales.show', $composition) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                    <a href="{{ route('composition_familiales.edit', $composition) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                    <form action="{{ route('composition_familiales.destroy', $composition) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer cette composition familiale ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">
                                    Aucune composition familiale enregistrée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-gray-100 bg-gray-50 px-6 py-4">
                {{ $compositions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
