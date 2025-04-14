<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="createUserForm">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createUserModalLabel">Ajouter un utilisateur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="createName" class="form-label">Nom</label>
              <input type="text" class="form-control" id="createName" name="name" required>
            </div>
            <div class="mb-3">
              <label for="createEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="createEmail" name="email" required>
            </div>
            <div class="mb-3">
              <label for="createRole" class="form-label">Rôle</label>
              <select class="form-select" id="createRole" name="role" required>
                <option value="">Choisir un rôle</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="pharmacien">Pharmacien</option>
                <option value="vendeur">Vendeur</option>
                <option value="caissier">Caissier</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="createPassword" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="createPassword" name="password" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary">Créer</button>
          </div>
        </div>
      </form>
    </div>
  </div>
