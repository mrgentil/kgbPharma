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
                        <h4 class="mb-sm-0">Gestion des Médicaments</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">Liste des Médicaments</a></li>
                                <li class="breadcrumb-item active">Médicaments</li>
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

                                <!-- Actions -->
                                <div class="row g-4 mb-3 align-items-center">
                                    <div class="col-sm-auto">
                                        <a href="{{ route('medicaments.create') }}" class="btn btn-success add-btn">
                                            <i class="ri-add-line align-bottom me-1"></i> Ajouter
                                        </a>
                                    </div>

                                    <div class="col">
                                        <div class="d-flex gap-2 flex-wrap">
                                            <button class="btn btn-outline-secondary filter-btn active" data-filter="all">Tous</button>
                                            <button class="btn btn-outline-danger filter-btn" data-filter="expired">Périmés</button>
                                            <button class="btn btn-outline-warning filter-btn" data-filter="low-stock">Stock faible</button>
                                            <button class="btn btn-outline-success filter-btn" data-filter="valid">Valides</button>
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control" id="searchInput" placeholder="Rechercher...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="medicamentsTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nom</th>
                                                <th>Forme/Dosage</th>
                                                <th>Prix</th>
                                                <th>Stock</th>
                                                <th>Expiration</th>
                                                <th>Fournisseur</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($medicaments as $medicament)
                                            <tr class="
                                                @if($medicament->isLowStock()) low-stock @endif
                                                @if($medicament->isExpired()) expired @endif
                                                @if(!$medicament->isExpired() && !$medicament->isLowStock()) valid @endif
                                            ">
                                                <td>{{ $medicament->nom }}</td>
                                                <td>{{ $medicament->forme }} ({{ $medicament->dosage }})</td>
                                                <td>
                                                    Achat: {{ number_format($medicament->prix_achat, 2) }}<br>
                                                    Vente: {{ number_format($medicament->prix_vente, 2) }}
                                                </td>
                                                <td>
                                                    {{ $medicament->stock }}
                                                    @if($medicament->isLowStock())
                                                        <span class="badge bg-warning">Stock faible</span>
                                                    @endif
                                                </td>
                                                <td @if($medicament->isExpired()) class="text-danger" @endif>
                                                    {{ $medicament->expiration->format('d/m/Y') }}
                                                    @if($medicament->isExpired())
                                                        <span class="badge bg-danger">Périmé</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($medicament->supplier)
                                                        {{ $medicament->supplier->nom }}
                                                    @else
                                                        <span class="text-muted">Aucun</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('medicaments.edit', $medicament->id) }}"
                                                            class="btn btn-sm btn-warning edit-btn">
                                                            Modifier
                                                        </a>
                                                        <form action="{{ route('medicaments.destroy', $medicament->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger delete-btn"
                                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce médicament ?')">
                                                                Supprimer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-end">
                                    {{ $medicaments->links('pagination::bootstrap-5') }}
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
    $(document).ready(function() {
        function filterTable() {
            const searchValue = $('#searchInput').val().toLowerCase();
            const filterType = $('.filter-btn.active').data('filter') || 'all';

            $('#medicamentsTable tbody tr').each(function() {
                const textMatch = $(this).text().toLowerCase().indexOf(searchValue) > -1;
                const matchesFilter =
                    filterType === 'all' ||
                    $(this).hasClass(filterType);

                $(this).toggle(textMatch && matchesFilter);
            });
        }

        // Recherche en temps réel
        $('#searchInput').on('keyup', function() {
            filterTable();
        });

        // Gestion des filtres
        $('.filter-btn').on('click', function() {
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');
            filterTable();
        });

        // Activer le filtre "Tous" au démarrage
        $('.filter-btn[data-filter="all"]').addClass('active');
    });
</script>
@endpush
