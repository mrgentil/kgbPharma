@extends('layouts.main')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Titre page -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Liste ventes</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="#">Ventes</a></li>
                                    <li class="breadcrumb-item active">Liste</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tableau -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Ajouter, Modifier et Supprimer</h4>
                            </div>
                            <div class="card-body">
                                <div id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <a href="{{ route('sales.create') }}" class="btn btn-success add-btn">
                                                <i class="ri-add-line align-bottom me-1"></i> Ajouter
                                            </a>
                                        </div>
                                        <div class="col-sm">
                                            <div class="d-flex justify-content-sm-end">
                                                <div class="search-box ms-2">
                                                    <input type="text" class="form-control" id="searchInput"
                                                        placeholder="Rechercher...">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form method="GET" action="{{ route('sales.index') }}" class="mb-3">
                                        <div class="row align-items-end">
                                            <div class="col-md-3">
                                                <label for="filtre">Filtrer par</label>
                                                <select name="filtre" id="filtre" class="form-select">
                                                    <option value="">-- Tous --</option>
                                                    <option value="jour" {{ request('filtre') == 'jour' ? 'selected' : '' }}>Aujourd’hui</option>
                                                    <option value="semaine" {{ request('filtre') == 'semaine' ? 'selected' : '' }}>Cette semaine</option>
                                                    <option value="mois" {{ request('filtre') == 'mois' ? 'selected' : '' }}>Ce mois</option>
                                                    <option value="annee" {{ request('filtre') == 'annee' ? 'selected' : '' }}>Cette année</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary">Appliquer</button>
                                            </div>
                                        </div>
                                    </form>


                                    <div class="table-responsive table-card mt-3 mb-1">
                                        <table class="table align-middle table-nowrap" id="usersTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Médicament</th>
                                                    <th>Quantité</th>
                                                    <th>Prix Unitaire</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ventes as $vente)
                                                    @foreach ($vente->details as $detail)
                                                        <tr id="sale-{{ $detail->id }}">
                                                            <td>{{ $vente->date_vente }}</td>
                                                            <td>{{ $detail->medicament->nom }}</td>
                                                            <td>{{ $detail->quantite }}</td>
                                                            <td>{{ number_format($detail->prix_unitaire, 2) }}</td>
                                                            <td>{{ number_format($detail->prix_unitaire * $detail->quantite, 2) }}
                                                            </td>
                                                            <td>
                                                                <div class="d-flex gap-2">
                                                                    <a href="{{ route('sales.edit', $detail->id) }}"
                                                                        class="btn btn-sm btn-warning edit-btn">
                                                                        Modifier
                                                                    </a>



                                                                    <form action="{{ route('sales.destroy', $detail->id) }}"
                                                                        method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-danger delete-btn"
                                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vente ?')">
                                                                            Supprimer
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        {{ $ventes->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Fonction de recherche
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('#usersTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endpush
