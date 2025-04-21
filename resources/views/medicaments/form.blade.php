@props(['medicament' => null, 'action' => '', 'method' => 'POST', 'suppliers' => []])

<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="modal-body">
        <!-- Nom du médicament -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du médicament</label>
            <input type="text" class="form-control" id="nom" name="nom"
                value="{{ old('nom', optional($medicament)->nom ?? '') }}" required>
        </div>

        <!-- Code-barres + Scanner -->
        <div class="mb-3">
            <label for="code_barre" class="form-label">Code-barres</label>
            <div class="input-group">
                <input type="text" class="form-control" id="code_barre" name="code_barre"
                    value="{{ old('code_barre', optional($medicament)->code_barre ?? '') }}" required>
                <button type="button" class="btn btn-outline-secondary" id="btn-scan">Scanner</button>
            </div>
            <div id="scanner" class="mt-2" style="width: 100%; height: 200px; display: none;"></div>
        </div>

        <!-- Zone d'affichage du scanner -->
        <div class="mb-3" id="scanner-container" style="display: none;">
            <video id="scanner-preview" style="width: 100%; border: 1px solid #ccc; border-radius: 5px;"></video>
            <button type="button" class="btn btn-danger mt-2" id="stopScannerBtn">Arrêter le scanner</button>
        </div>


        <!-- Forme et dosage -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="forme" class="form-label">Forme pharmaceutique</label>
                <input type="text" class="form-control" id="forme" name="forme"
                    value="{{ old('forme', optional($medicament)->forme ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="dosage" class="form-label">Dosage</label>
                <input type="text" class="form-control" id="dosage" name="dosage"
                    value="{{ old('dosage', optional($medicament)->dosage ?? '') }}">
            </div>
        </div>

        <!-- Prix -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="prix_achat" class="form-label">Prix d'achat (FC)</label>
                <input type="number" step="0.01" class="form-control" id="prix_achat" name="prix_achat"
                    value="{{ old('prix_achat', optional($medicament)->prix_achat ?? '') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="prix_vente" class="form-label">Prix de vente (FC)</label>
                <input type="number" step="0.01" class="form-control" id="prix_vente" name="prix_vente"
                    value="{{ old('prix_vente', optional($medicament)->prix_vente ?? '') }}" required>
            </div>
        </div>

        <!-- Stock -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Quantité en stock</label>
                <input type="number" class="form-control" id="stock" name="stock"
                    value="{{ old('stock', optional($medicament)->stock ?? 0) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="stock_min" class="form-label">Stock minimum d'alerte</label>
                <input type="number" class="form-control" id="stock_min" name="stock_min"
                    value="{{ old('stock_min', optional($medicament)->stock_min ?? 5) }}" required>
            </div>
        </div>

        <!-- Date d'expiration -->
        <div class="mb-3">
            <label for="expiration" class="form-label">Date d'expiration</label>
            <input type="date" class="form-control" id="expiration" name="expiration"
                value="{{ old('expiration', optional($medicament)->expiration ? $medicament->expiration->format('Y-m-d') : '') }}"
                required>
        </div>

        <!-- Fournisseur -->
        <div class="mb-3">
            <label for="supplier_id" class="form-label">Fournisseur</label>
            <select class="form-select" id="supplier_id" name="supplier_id">
                <option value="">Sélectionner un fournisseur</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @selected(old('supplier_id', optional($medicament)->supplier_id ?? null) == $supplier->id)>
                        {{ $supplier->nom }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
