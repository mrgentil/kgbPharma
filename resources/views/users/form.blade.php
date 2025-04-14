@props(['user' => null, 'action' => '', 'method' => 'POST'])

<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="modal-body">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $user->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="{{ old('email', $user->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select class="form-select" id="role" name="role" required>
                <option value="">Sélectionner un rôle</option>
                <option value="Admin" @selected(old('role', $user->role ?? null) === 'Admin')>Admin</option>
                <option value="Manager" @selected(old('role', $user->role ?? null) === 'Manager')>Manager</option>
                <option value="Pharmacien" @selected(old('role', $user->role ?? null) === 'Pharmacien')>Pharmacien</option>
                <option value="Vendeur" @selected(old('role', $user->role ?? null) === 'Vendeur')>Vendeur</option>
                <option value="Caissier" @selected(old('role', $user->role ?? null) === 'Caissier')>Caissier</option>
            </select>
        </div>

        @if(!$user)
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
        @endif
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
