<div class="modal fade" id="suspendUserModal" tabindex="-1" aria-labelledby="suspendUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="suspendUserForm">
        @csrf
        <input type="hidden" id="suspendUserId" name="id">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="suspendUserModalLabel"><span id="suspendUserStatusText"></span> l'utilisateur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Êtes-vous sûr de vouloir <strong><span id="suspendUserStatusText"></span></strong> cet utilisateur ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-warning">Confirmer</button>
          </div>
        </div>
      </form>
    </div>
  </div>
