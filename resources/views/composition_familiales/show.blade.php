<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Détails de la composition familiale</h2>
                <p class="text-sm text-gray-500">Vue detaillee de l'acte et des membres de la famille.</p>
            </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('composition_familiales.attestation', $compositionFamiliale) }}"
                        class="inline-flex items-center rounded-2xl bg-green-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-green-700">
                        📄 Attestation
                    </a>
                    
                </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('composition_familiales.edit', $compositionFamiliale) }}"
                    class="inline-flex items-center rounded-2xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-indigo-700">
                    ✏️ Modifier
                </a>
                <a href="{{ route('composition_familiales.index') }}"
                    class="inline-flex items-center rounded-2xl bg-gray-100 px-4 py-2 text-xs font-semibold text-gray-700 shadow-sm hover:bg-gray-200">
                    ← Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-[1.8fr,0.9fr] mb-8">
            <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm">
                <p class="text-xs uppercase tracking-[0.24em] text-indigo-600 font-semibold">Acte de composition familiale</p>
                <h1 class="mt-2 text-3xl font-bold text-gray-900">{{ $compositionFamiliale->num_acte ?? 'N/A' }}</h1>
                <p class="mt-3 text-sm text-gray-500">Enregistre le {{ $compositionFamiliale->created_at?->format('d/m/Y a H:i') }}</p>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-indigo-50 p-5">
                        <p class="text-sm text-gray-500">Soussignataire</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $compositionFamiliale->soussignataire ?? 'N/A' }}</p>
                    </div>
                    <div class="rounded-3xl bg-blue-50 p-5">
                        <p class="text-sm text-gray-500">Nombre d'enfants</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $compositionFamiliale->nombre_enfants ?? 0 }}</p>
                    </div>
                </div>

                <div class="mt-6 rounded-3xl border border-gray-200 bg-gray-50 p-5">
                    <p class="text-sm font-semibold text-gray-700">Couple concerne</p>
                    <p class="mt-2 text-gray-800">
                        {{ $compositionFamiliale->mariage->epoux->nom ?? '-' }} {{ $compositionFamiliale->mariage->epoux->prenom ?? '' }}
                        &amp;
                        {{ $compositionFamiliale->mariage->epouse->nom ?? '-' }} {{ $compositionFamiliale->mariage->epouse->prenom ?? '' }}
                    </p>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold text-gray-500">Administration</p>
                    <p class="mt-3 text-base font-semibold text-gray-900">{{ $compositionFamiliale->entite->nom ?? 'Entite inconnue' }}</p>
                    <p class="mt-1 text-sm text-gray-500">Agent: {{ $compositionFamiliale->user->name ?? 'Inconnu' }}</p>
                    @if($compositionFamiliale->documents)
                        <a href="{{ asset('storage/' . $compositionFamiliale->documents) }}" target="_blank"
                            class="mt-4 inline-flex items-center rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                            Voir le document
                        </a>
                    @endif
                </div>

                @if($compositionFamiliale->personne)
                    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                        <p class="text-sm font-semibold text-gray-500">Titulaire</p>
                        <p class="mt-3 text-base font-semibold text-gray-900">
                            {{ $compositionFamiliale->personne->nom }} {{ $compositionFamiliale->personne->postnom }} {{ $compositionFamiliale->personne->prenom }}
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-gray-700">Liste des enfants</p>
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-gray-500 uppercase tracking-wider">Nom complet</th>
                            <th class="px-4 py-3 font-semibold text-gray-500 uppercase tracking-wider">Sexe</th>
                            <th class="px-4 py-3 font-semibold text-gray-500 uppercase tracking-wider">Date de naissance</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($compositionFamiliale->enfants as $enfant)
                            <tr>
                                <td class="px-4 py-3 text-gray-800">{{ $enfant->nom }} {{ $enfant->postnom }} {{ $enfant->prenom }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $enfant->sexe ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ optional($enfant->date_naissance)->format('d/m/Y') ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-sm text-gray-500">Aucun enfant associe a cette composition.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
