<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier un rôle</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('roles.update', $role) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        @include('roles._form')
                        <div class="flex items-center gap-4">
                            <x-primary-button>Mettre à jour</x-primary-button>
                            <a href="{{ route('roles.index') }}" class="text-gray-600 hover:text-gray-900">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
