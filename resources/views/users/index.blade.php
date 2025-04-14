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
                            <h4 class="mb-sm-0">Liste des Utilisateurs</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="#">Utilisateurs</a></li>
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
                                <h4 class="card-title mb-0">Ajouter, modifier et suspendre</h4>
                            </div>
                            <div class="card-body">
                                <div id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <a href="{{ route('users.create') }}" class="btn btn-success add-btn">
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

                                    <div class="table-responsive table-card mt-3 mb-1">
                                        <table class="table align-middle table-nowrap" id="usersTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Email</th>
                                                    <th>Rôle</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr id="user-{{ $user->id }}">
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ ucfirst($user->role) }}</td>
                                                        <td>
                                                            @if ($user->is_suspended)
                                                                <span class="badge bg-danger">Suspendu</span>
                                                            @else
                                                                <span class="badge bg-success">Actif</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <a href="{{ route('users.edit', $user->id) }}"
                                                                    class="btn btn-sm btn-warning edit-btn">
                                                                    Modifier
                                                                </a>

                                                                <form action="{{ route('users.suspend', $user->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-secondary suspend-btn">
                                                                        {{ $user->is_suspended ? 'Activer' : 'Suspendre' }}
                                                                    </button>
                                                                </form>

                                                                <form action="{{ route('users.destroy', $user->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-danger delete-btn"
                                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
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

                                    <div class="d-flex justify-content-end">
                                        {{ $users->links('pagination::bootstrap-5') }}
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
