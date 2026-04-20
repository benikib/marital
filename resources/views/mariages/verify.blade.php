<x-app-layout>
    <div class="p-6">
        <h1 class="text-xl font-bold">Vérification du mariage</h1>

        <p><b>Époux :</b> {{ $mariage->epoux->nom }} {{ $mariage->epoux->prenom }}</p>
        <p><b>Épouse :</b> {{ $mariage->epouse->nom }} {{ $mariage->epouse->prenom }}</p>
        <p><b>Date :</b> {{ $mariage->date_mariage }}</p>
        <p><b>Statut :</b> {{ $mariage->statut->nom ?? '' }}</p>

        <div class="mt-4 text-green-600 font-bold">
            ✔ Document valide
        </div>
    </div>
</x-app-layout>