@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <!-- Section Historique des mouvements -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h4>Historique des mouvements de stock</h4>
                <span class="badge bg-light text-dark">
                    {{ $totalMedicaments }} médicament(s) enregistré(s)
                </span>
            </div>
            <div class="card-body">
                @if($mouvements->isEmpty())
                    <div class="alert alert-info">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle me-3 fa-2x"></i>
                            <div>
                                <h5>Aucun mouvement enregistré</h5>
                                <p class="mb-0">
                                    Le système ne contient encore aucun mouvement de stock,
                                    bien que {{ $totalMedicaments }} médicament(s) soit(en)t enregistré(s).
                                </p>
                                <a href="{{ route('medicaments.create') }}" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus"></i> Ajouter un médicament
                                </a>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <!-- Tableau existant -->
                    </div>
                @endif
            </div>
        </div>

        <!-- Section Produits expirés ou bientôt expirés -->

    </div>
@endsection
