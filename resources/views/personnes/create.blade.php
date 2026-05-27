<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Créer une personne</h2>
    </x-slot>

    <div class="py-12">
        <div class="">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   
                    <form action="{{ route('personnes.store') }}"  method="POST" enctype="multipart/form-data"  class="space-y-6">
                        @csrf
                        @include('personnes._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
