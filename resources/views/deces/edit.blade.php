<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier une attestation de décès</h2>
    </x-slot>

    <div class="py-12">
        <div class="">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('deces.update', $dece) }}" enctype="multipart/form-data" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        @include('deces._form')
                        <div class="mt-4 flex items-center gap-4">
                            <x-primary-button>Mettre à jour</x-primary-button>
                            <a href="{{ route('deces.index') }}" class="text-gray-600 hover:text-gray-900">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
