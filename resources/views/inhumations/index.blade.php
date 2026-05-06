<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Inhumations</h2>
            <a href="{{ route('inhumations.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">Nouvelle Inhumation</a>
        </div>
    </x-slot>

    <div class="p-6 space-y-6">
        <div class="  ">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">{{ session('success') }}</div>
            @endif

            @include('components.index-search-stats', ['stats' => $stats ?? null])

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Noms, lieu et dates de naissance</th>
                                    
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'inhumation</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lieu d'inhumation</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cimetière</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entité d'enregistrement</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($inhumations as $inhumation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $inhumation->personne->nom ?? 'N/A' }} {{ $inhumation->personne->postnom ?? ' -' }} {{ $inhumation->personne->prenom ?? '-' }} {{ $inhumation->personne->lieu_naissance ?? 'N/A' }} {{ $inhumation->personne->date_naissance->format('d/m/Y') ?? ' -' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $inhumation->date_inhumation ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $inhumation->lieu_inhumation ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $inhumation->cimetiere ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $inhumation->entite->nom  ?? 'N/A' }} ({{ ($inhumation->entite->type  ?? 'N/A') }}) </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('inhumations.show', $inhumation) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                            <a href="{{ route('inhumations.edit', $inhumation) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form action="{{ route('inhumations.destroy', $inhumation) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer cette inhumation ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $inhumations->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
