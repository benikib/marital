<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            👥 Ajouter les témoins
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-lg rounded-2xl p-6">

                <form action="{{ route('mariages.temoins.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- ID MARIAGE -->
                    <input type="hidden" name="mariage_id" value="{{ $mariage->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- TEMOIN EPOUX -->
                        <div>
                            <x-input-label for="temoin_epoux" value="Témoin de l'Époux" />

                            <select id="temoin_epoux" name="temoin_epoux" class="search-select" required>
                                <option value="">Sélectionner</option>
                                @foreach($personnes as $personne)
                                    <option value="{{ $personne->id }}">
                                        {{ $personne->nom }} {{ $personne->prenom }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('temoin_epoux')" />
                        </div>

                        <!-- TEMOIN EPOUSE -->
                        <div>
                            <x-input-label for="temoin_epouse" value="Témoin de l'Épouse" />

                            <select id="temoin_epouse" name="temoin_epouse" class="search-select" required>
                                <option value="">Sélectionner</option>
                                @foreach($personnes as $personne)
                                    <option value="{{ $personne->id }}">
                                        {{ $personne->nom }} {{ $personne->prenom }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('temoin_epouse')" />
                        </div>

                    </div>

                    <!-- ACTIONS -->
                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('mariages.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Annuler
                        </a>

                        <x-primary-button class="px-6 py-2">
                            Enregistrer
                        </x-primary-button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
