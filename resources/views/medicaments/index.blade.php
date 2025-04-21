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
                                                <input type="text" id="search" class="form-control" placeholder="Rechercher...">
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
                                                <th>Code-barres</th>
                                                <th>Fournisseur</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($medicaments as $medicament)
                                                <tr class="@if ($medicament->isLowStock()) low-stock @endif @if ($medicament->isExpired()) expired @endif @if (!$medicament->isExpired() && !$medicament->isLowStock()) valid @endif">
                                                    <td>{{ $medicament->nom }}</td>
                                                    <td>{{ $medicament->forme }} ({{ $medicament->dosage }})</td>
                                                    <td>
                                                        Achat: {{ number_format($medicament->prix_achat, 2) }}<br>
                                                        Vente: {{ number_format($medicament->prix_vente, 2) }}
                                                    </td>
                                                    <td>
                                                        {{ $medicament->stock }}
                                                        @if ($medicament->isLowStock())
                                                            <span class="badge bg-warning">Stock faible</span>
                                                        @endif
                                                    </td>
                                                    <td @if ($medicament->isExpired()) class="text-danger" @endif>
                                                        {{ $medicament->expiration->format('d/m/Y') }}
                                                        @if ($medicament->isExpired())
                                                            <span class="badge bg-danger">Périmé</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $medicament->code_barre }}</td>
                                                    <td>
                                                        @if ($medicament->supplier)
                                                            {{ $medicament->supplier->nom }}
                                                        @else
                                                            <span class="text-muted">Aucun</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('medicaments.edit', $medicament->id) }}" class="btn btn-sm btn-warning edit-btn">Modifier</a>
                                                            <form action="{{ route('medicaments.destroy', $medicament->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce médicament ?')">Supprimer</button>
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
    // Filtres
    $('.filter-btn').click(function () {
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        const filter = $(this).data('filter');
        $('#medicamentsTable tbody tr').each(function () {
            const row = $(this);
            if (filter === 'all') {
                row.show();
            } else if (!row.hasClass(filter)) {
                row.hide();
            } else {
                row.show();
            }
        });
    });

    // Recherche
    $('#search').on('keyup', function () {
        const value = $(this).val().toLowerCase();
        $('#medicamentsTable tbody tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Soumission AJAX (si formulaire modale présent avec id "formAddMedicament")
    $('#formAddMedicament').on('submit', function (e) {
        e.preventDefault();
        const form = $(this);
        const data = form.serialize();

        $.ajax({
            url: "{{ route('medicaments.store') }}",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.status === 'success') {
                    $('#alertMessage').removeClass('d-none alert-danger').addClass('alert-success').text(response.message);
                    form.trigger('reset');
                    $('#addMedicamentModal').modal('hide');
                    location.reload(); // ou reloadTableViaAjax();
                }
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMsg = Object.values(errors).map(v => v[0]).join('<br>');
                $('#alertMessage').removeClass('d-none alert-success').addClass('alert-danger').html(errorMsg);
            }
        });
    });

    // Focus automatique pour scanner USB
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('code_barre')?.focus();
    });

    // Si l'utilisateur scanne via scanner USB
    document.getElementById('code_barre')?.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            console.log('Code scanné :', this.value);
            // Tu peux lancer une action ici, comme une recherche automatique
        }
    });
</script>
@endpush
