<!-- resources/views/medicaments/modals/create.blade.php -->

<div class="modal fade" id="createMedicamentModal" tabindex="-1" aria-labelledby="createMedicamentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="createMedicamentForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Ajouter un Médicament</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body row">
                    <div class="mb-3 col-md-6">
                        <label for="code_barre" class="form-label">Code-barres</label>
                        <input type="text" class="form-control" id="code_barre" name="code_barre" placeholder="Scanner ici..." autofocus>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="categorie" class="form-label">Catégorie</label>
                        <input type="text" class="form-control" name="categorie" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="prix" class="form-label">Prix</label>
                        <input type="number" step="0.01" class="form-control" name="prix" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="quantite" class="form-label">Quantité</label>
                        <input type="number" class="form-control" name="quantite" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="date_expiration" class="form-label">Date d'expiration</label>
                        <input type="date" class="form-control" name="date_expiration" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>
