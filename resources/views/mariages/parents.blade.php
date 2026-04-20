
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            💍 Créer un mariage
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto mt-10 sm:px-6 lg:px-8">

        <!-- CARD -->
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">

            <!-- SECTION TITLE -->
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Informations des parents
            </h3>

            <form method="POST" action="{{ route('mariages.parents.store') }}">
                @csrf
                <input type="hidden" name="mariage_id" value="{{ $mariage->id }}" />  
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Père Epoux -->
                    <div>
                        <x-input-label for="pere_epoux" value="Père de l'Époux" />
                        <select name="pere_epoux" id="pere_epoux" class="search-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-md shadow-sm">
                            <option value="">Sélectionner</option>
                            @foreach($personnes as $personne)
                                <option value="{{ $personne->id }}">
                                    {{ $personne->nom }} {{ $personne->prenom }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('pere_epoux')" class="mt-2" />
                    </div>

                    <!-- Mère Epoux -->
                    <div>
                        <x-input-label for="mere_epoux" value="Mère de l'Époux" />
                        <select name="mere_epoux" id="mere_epoux" class="search-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-md shadow-sm">
                            <option value="">Sélectionner</option>
                            @foreach($personnes as $personne)
                                <option value="{{ $personne->id }}">
                                    {{ $personne->nom }} {{ $personne->prenom }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('mere_epoux')" class="mt-2" />
                    </div>

                    <!-- Père Epouse -->
                    <div>
                        <x-input-label for="pere_epouse" value="Père de l'Épouse" />
                        <select name="pere_epouse" id="pere_epouse" class="search-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-md shadow-sm">
                            <option value="">Sélectionner</option>
                            @foreach($personnes as $personne)
                                <option value="{{ $personne->id }}">
                                    {{ $personne->nom }} {{ $personne->prenom }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('pere_epouse')" class="mt-2" />
                    </div>

                    <!-- Mère Epouse -->
                    <div>
                        <x-input-label for="mere_epouse" value="Mère de l'Épouse" />
                        <select name="mere_epouse" id="mere_epouse" class="search-select border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-md shadow-sm">
                            <option value="">Sélectionner</option>
                            @foreach($personnes as $personne)
                                <option value="{{ $personne->id }}">
                                    {{ $personne->nom }} {{ $personne->prenom }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('mere_epouse')" class="mt-2" />
                    </div>

                </div>

                <!-- ACTIONS -->
                <div class="flex justify-end gap-3 mt-8">

                    <a href="{{ route('mariages.index') }}"
                       class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                        Annuler
                    </a>

                    <x-primary-button class="px-6 py-2">
                        Enregistrer
                    </x-primary-button>

                </div>

            </form>
        </div>
    </div>
</x-app-layout>


   

    

   
