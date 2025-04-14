<!-- Modal Create User -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="createUserForm">
                @csrf
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="createUserLabel">Créer un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div id="createUserSuccess" class="alert alert-success d-none"></div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select class="form-control" name="role" required>
                            <option value="">-- Choisir un rôle --</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="pharmacien">Pharmacien</option>
                            <option value="vendeur">Vendeur</option>
                            <option value="caissier">Caissier</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer mot de passe</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Créer</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
