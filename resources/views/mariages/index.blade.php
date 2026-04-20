<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mariages</h2>
            <a href="{{ route('mariages.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">Nouveau mariage</a>
        </div>
    </x-slot>
<form method="GET" class="mt-6 mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">

    <!-- Recherche -->
    <input type="text" name="search"
        value="{{ request('search') }}"
        placeholder="🔍 Rechercher époux ou épouse..."
        class="rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

    <!-- Date -->
    <input type="date" name="date"
        value="{{ request('date') }}"
        class="rounded-lg border-gray-300 shadow-sm">

    <!-- Lieu -->
    <input type="text" name="lieu"
        value="{{ request('lieu') }}"
        placeholder="📍 Lieu"
        class="rounded-lg border-gray-300 shadow-sm">

    <!-- Boutons -->
    <div class="flex gap-2">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
            Filtrer
        </button>

        <a href="{{ route('mariages.index') }}"
           class="px-4 py-2 bg-gray-300 rounded-lg">
            Reset
        </a>
    </div>

</form>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table id="tableMariages" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Époux</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Épouse</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lieu</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($mariages as $mariage)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mariage->epoux->nom ?? '-' }} {{ $mariage->epoux->prenom ?? '' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $mariage->epouse->nom ?? '-' }} {{ $mariage->epouse->prenom ?? '' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ optional($mariage->date_mariage)->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mariage->lieu_mariage }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('mariages.show', $mariage) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                                
                                            <a href="{{ route('mariages.temoins', $mariage) }}" class="text-green-600 hover:text-green-900">Témoins</a>

                                            <a href="{{ route('mariages.parents', $mariage) }}" class="text-yellow-600 hover:text-yellow-900">Parents</a>
                                            <a href="{{ route('mariages.edit', $mariage) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                            <form action="{{ route('mariages.destroy', $mariage) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Supprimer ce mariage ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $mariages->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    <script>
$(document).ready(function () {
    $('#tableMariages').DataTable({
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
