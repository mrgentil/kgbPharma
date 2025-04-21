@props(['sale' => null, 'action' => '', 'method' => 'POST', 'medicaments' => []])

<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="modal-body">
        <div id="ligne-medicaments">
            @php
                $details = old('medicament_id') ? collect(old('medicament_id'))->map(function ($id, $i) use ($sale) {
                    return [
                        'medicament_id' => $id,
                        'quantite' => old("quantite.$i"),
                        'prix_unitaire' => old("prix_unitaire.$i")
                    ];
                }) : ($sale ? $sale->details : collect([['medicament_id' => '', 'quantite' => '', 'prix_unitaire' => '']]));
            @endphp

            @foreach ($details as $index => $detail)
                <div class="row mb-2 ligne">
                    <div class="col-md-4">
                        <select class="form-select medicament-select" name="medicament_id[]" required>
                            <option value="">-- Choisir un médicament --</option>
                            @foreach ($medicaments as $medicament)
                                <option
                                    value="{{ $medicament->id }}"
                                    data-prix="{{ $medicament->prix_vente }}"
                                    @selected($detail['medicament_id'] == $medicament->id)>
                                    {{ $medicament->nom }} ({{ $medicament->code_barre }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="number" class="form-control quantite" name="quantite[]" value="{{ $detail['quantite'] ?? '' }}" required>
                    </div>

                    <div class="col-md-2">
                        <input type="number" class="form-control prix_unitaire" name="prix_unitaire[]" value="{{ $detail['prix_unitaire'] ?? '' }}" readonly required>
                    </div>

                    <div class="col-md-2">
                        <input type="number" class="form-control sous_total" readonly>
                    </div>

                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-remove-ligne">−</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-end">
            <button type="button" id="btn-ajouter-ligne" class="btn btn-secondary">+ Ajouter un médicament</button>
        </div>

        <hr>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" id="total" name="total" value="{{ old('total', $sale->total ?? '') }}" readonly required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
            {{ $method === 'POST' ? 'Enregistrer' : 'Mettre à jour' }}
        </button>
    </div>
</form>

@once
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.ligne').forEach(function (row) {
                const prix = parseFloat(row.querySelector('.prix_unitaire').value || 0);
                const qte = parseFloat(row.querySelector('.quantite').value || 0);
                const sousTotal = prix * qte;
                row.querySelector('.sous_total').value = sousTotal.toFixed(2);
                total += sousTotal;
            });
            document.getElementById('total').value = total.toFixed(2);
        }

        document.querySelectorAll('#ligne-medicaments').forEach(container => {
            container.addEventListener('change', function (e) {
                if (e.target.classList.contains('medicament-select')) {
                    const prix = parseFloat(e.target.selectedOptions[0].dataset.prix || 0);
                    e.target.closest('.ligne').querySelector('.prix_unitaire').value = prix;
                    updateTotal();
                }
            });

            container.addEventListener('input', function (e) {
                if (e.target.classList.contains('quantite')) {
                    updateTotal();
                }
            });

            container.addEventListener('click', function (e) {
                if (e.target.classList.contains('btn-remove-ligne')) {
                    e.target.closest('.ligne').remove();
                    updateTotal();
                }
            });
        });

        document.getElementById('btn-ajouter-ligne').addEventListener('click', function () {
            const ligne = document.querySelector('.ligne');
            const clone = ligne.cloneNode(true);

            clone.querySelectorAll('input').forEach(input => {
                input.value = '';
            });

            clone.querySelector('.sous_total').value = '';
            document.getElementById('ligne-medicaments').appendChild(clone);
        });

        updateTotal();
    });
</script>
@endpush
@endonce
