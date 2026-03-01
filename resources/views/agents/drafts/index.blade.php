@extends('layouts.agents.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6>Brouillons de mariages</h6>
                        <a href="{{ route('agent.mariagescommunes.create') }}" class="btn btn-primary btn-sm">Nouveau</a>
                    </div>
                    <div class="card-body">
                        @if($drafts->isEmpty())
                            <p>Aucun brouillon enregistré.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Créé le</th>
                                            <th>Données</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($drafts as $draft)
                                            <tr id="draft-row-{{ $draft->id }}">
                                                <td>{{ $draft->id }}</td>
                                                <td>{{ $draft->created_at->format('Y-m-d H:i') }}</td>
                                                <td style="max-width:400px; overflow:auto; white-space:nowrap">{{ json_encode($draft->data) }}</td>
                                                <td>
                                                    <a href="{{ route('agent.mariagescommunes.create') }}?draft={{ $draft->id }}" class="btn btn-sm btn-outline-success">Charger</a>
                                                    <button class="btn btn-sm btn-danger" onclick="deleteDraft({{ $draft->id }})">Supprimer</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        function deleteDraft(id) {
            if (!confirm('Supprimer ce brouillon ?')) return;
            fetch(`/mariage-drafts/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            }).then(resp => {
                if (resp.ok) {
                    document.getElementById(`draft-row-${id}`)?.remove();
                } else {
                    alert('Impossible de supprimer le brouillon');
                }
            }).catch(err => {
                console.error(err);
                alert('Erreur réseau');
            });
        }
    </script>
@endsection
