<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Détails du divorce</h2>
                <p class="text-sm text-gray-500">Vue détaillée de l’acte et du couple concerné.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('divorces.attestation', $divorce) }}" target="_blank" class="inline-flex items-center rounded-2xl bg-blue-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-blue-700">👁️ Voir attestation</a>
                <a href="{{ route('divorces.edit', $divorce) }}" class="inline-flex items-center rounded-2xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-indigo-700">✏️ Modifier</a>
                <a href="{{ route('divorces.index') }}" class="inline-flex items-center rounded-2xl bg-gray-100 px-4 py-2 text-xs font-semibold text-gray-700 shadow-sm hover:bg-gray-200">← Retour</a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-[1.8fr,0.9fr] mb-8">
            <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm">
                <div class="flex flex-col gap-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.24em] text-red-600 font-semibold">Acte de divorce</p>
                            <h1 class="mt-2 text-3xl font-bold text-gray-900">{{ $divorce->mariage->epoux->prenom ?? '-' }} {{ $divorce->mariage->epoux->nom ?? '-' }} &amp; {{ $divorce->mariage->epouse->prenom ?? '-' }} {{ $divorce->mariage->epouse->nom ?? '-' }}</h1>
                        </div>
                        <div class="space-y-2 text-sm text-right text-gray-500">
                            <div>Enregistré le {{ $divorce->created_at->format('d/m/Y à H:i') }}</div>
                            <div>Acte n° {{ $divorce->num_acte }}</div>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-3xl bg-red-50 p-5">
                            <p class="text-sm text-gray-500">Date du divorce</p>
                            <p class="mt-2 text-xl font-semibold text-gray-900">{{ optional(optional($divorce)->date_divorce)->format('d/m/Y') ?? 'N/A' }}</p>
                        </div>
                        <div class="rounded-3xl bg-pink-50 p-5">
                            <p class="text-sm text-gray-500">Tribunal</p>
                            <p class="mt-2 text-xl font-semibold text-gray-900">{{ $divorce->divorce_rendu ?? 'N/A' }}</p>
                        </div>
                        <div class="rounded-3xl bg-indigo-50 p-5">
                            <p class="text-sm text-gray-500">Entité</p>
                            <p class="mt-2 text-xl font-semibold text-gray-900">{{ $divorce->entite->nom ?? 'N/A' }}</p>
                        </div>
                    </div>

                    @if($divorce->mentions_complementaire)
                        <div class="rounded-3xl border border-gray-200 bg-gray-50 p-6">
                            <p class="text-sm font-semibold text-gray-700">Mentions complémentaires</p>
                            <p class="mt-3 text-gray-700">{{ $divorce->mentions_complementaire }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-3xl bg-gradient-to-br from-red-500 via-pink-500 to-fuchsia-500 p-6 text-white shadow-lg">
                    <p class="text-sm uppercase tracking-[0.24em] text-pink-100">Résumé rapide</p>
                    <div class="mt-5 grid gap-4">
                        <div class="rounded-3xl bg-white/10 p-4">
                            <p class="text-xs text-pink-100">Jugement</p>
                            <p class="mt-2 text-lg font-semibold">{{ $divorce->numero_jugement ?? 'N/A' }}</p>
                        </div>
                        <div class="rounded-3xl bg-white/10 p-4">
                            <p class="text-xs text-pink-100">Transcription</p>
                            <p class="mt-2 text-lg font-semibold">{{ $divorce->date_transcription ? \Carbon\Carbon::parse($divorce->date_transcription)->format('d/m/Y') : 'N/A' }}</p>
                        </div>
                        <div class="rounded-3xl bg-white/10 p-4">
                            <p class="text-xs text-pink-100">Soussignataire</p>
                            <p class="mt-2 text-lg font-semibold">{{ $divorce->soussignataire ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold text-gray-500">Informations utilisateur</p>
                    <p class="mt-3 text-base font-semibold text-gray-900">{{ $divorce->user->name ?? 'Utilisateur inconnu' }}</p>
                    @if($divorce->documents)
                        <a href="{{ asset('storage/' . $divorce->documents) }}" target="_blank" class="mt-4 inline-flex items-center rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Voir le document</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3 mb-8">
            <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold text-gray-500">Ancien époux</p>
                <p class="mt-4 text-lg font-semibold text-gray-900">{{ $divorce->mariage->epoux->prenom ?? '-' }} {{ $divorce->mariage->epoux->nom ?? '-' }}</p>
                <p class="mt-2 text-sm text-gray-500">{{ $divorce->mariage->epoux->date_naissance ?? 'Non renseignée' }}</p>
                <span class="mt-4 inline-flex rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700">{{ $divorce->mariage->epoux->etat_civil ?? 'N/A' }}</span>
            </div>

            <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold text-gray-500">Ancienne épouse</p>
                <p class="mt-4 text-lg font-semibold text-gray-900">{{ $divorce->mariage->epouse->prenom ?? '-' }} {{ $divorce->mariage->epouse->nom ?? '-' }}</p>
                <p class="mt-2 text-sm text-gray-500">{{ $divorce->mariage->epouse->date_naissance ?? 'Non renseignée' }}</p>
                <span class="mt-4 inline-flex rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700">{{ $divorce->mariage->epouse->etat_civil ?? 'N/A' }}</span>
            </div>

            <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold text-gray-500">Mariage d'origine</p>
                <div class="mt-4 space-y-3 text-gray-700">
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-gray-400">Date</p>
                        <p class="mt-1 font-semibold">{{ \Carbon\Carbon::parse($divorce->mariage->date_mariage)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-gray-400">Lieu</p>
                        <p class="mt-1 font-semibold">{{ $divorce->mariage->lieu_mariage }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.24em] text-gray-400">Statut</p>
                        <p class="mt-1 font-semibold text-red-600">{{ $divorce->mariage->statut->nom ?? 'Dissous' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>