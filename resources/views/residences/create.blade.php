<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Créer une attestation de residence</h2>
    </x-slot>

    <div class="py-12">
        <div class="">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   
                    <form action="{{ route('residences.store') }}"  method="POST" enctype="multipart/form-data"  class="space-y-6">
                        @csrf
                        @include('residences._form')
                        <div class="flex items-center gap-4 mt-4">
                            <x-primary-button>Enregistrer</x-primary-button>
                            <a href="{{ route('residences.index') }}" class="text-gray-600 hover:text-gray-900">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
