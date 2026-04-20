<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Créer une personne</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   
                    <form action="{{ route('personnes.store') }}"  method="POST" enctype="multipart/form-data"  class="space-y-6">
                        @csrf
                        @include('personnes._form')
                        <div class="flex items-center gap-4">
                            <x-primary-button>Enregistrer</x-primary-button>
                            <a href="{{ route('personnes.index') }}" class="text-gray-600 hover:text-gray-900">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
