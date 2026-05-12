<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">Modifier la composition familiale</h2>
            <p class="text-sm text-gray-500">Mettez a jour les informations de l'acte existant.</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm">
                <form action="{{ route('composition_familiales.update', $compositionFamiliale) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    @include('composition_familiales._form')

                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                        <a href="{{ route('composition_familiales.show', $compositionFamiliale) }}"
                            class="inline-flex items-center justify-center rounded-2xl border border-gray-200 bg-gray-100 px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200">
                            Annuler
                        </a>
                        <x-primary-button>Enregistrer les modifications</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
