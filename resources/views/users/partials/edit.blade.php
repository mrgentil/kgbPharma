<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="editUserForm">
        @csrf
        @method('PUT')
        <input type="hidden" id="editUserId" name="id">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editUserModalLabel">Modifier l'utilisateur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="editUserName" class="form-label">Nom</label>
              <input type="text" class="form-control" id="editUserName" name="name" required>
            </div>
            <div class="mb-3">
              <label for="editUserEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="editUserEmail" name="email" required>
            </div>
            <div class="mb-3">
              <label for="editUserRole" class="form-label">Rôle</label>
              <select class="form-select" id="editUserRole" name="role" required>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="pharmacien">Pharmacien</option>
                <option value="vendeur">Vendeur</option>
                <option value="caissier">Caissier</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
          </div>
        </div>
      </form>
    </div>
  </div>
