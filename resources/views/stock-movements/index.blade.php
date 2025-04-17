@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h4>Historique des mouvements de stock</h4>
    <div class="table-responsive">
        <table class="table table-bordered" id="stockTable">
            <thead>
                <tr>
                    <th>Médicament</th>
                    <th>Type</th>
                    <th>Quantité</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mouvements as $mouvement)
                    <tr>
                        <td>{{ $mouvement->medicament->nom ?? '—' }}</td>
                        <td>
                            @if ($mouvement->type === 'entrée')
                                <span class="badge bg-success">Entrée</span>
                            @elseif ($mouvement->type === 'sortie')
                                <span class="badge bg-danger">Sortie</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($mouvement->type) }}</span>
                            @endif
                        </td>
                        <td>{{ $mouvement->quantite }}</td>
                        <td>{{ $mouvement->description ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($mouvement->created_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
