<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">Créer un divorce</h2>
            <p class="text-sm text-gray-500">Enregistrez un nouvel acte de divorce et liez-le au mariage concerné.</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm">
                <form action="{{ route('divorces.store') }}" enctype="multipart/form-data" method="POST" class="space-y-6">
                    @csrf
                    @include('divorces._form')
                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                        <a href="{{ route('divorces.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-gray-100 px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200">Annuler</a>
                        <x-primary-button>Enregistrer</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>