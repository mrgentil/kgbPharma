<table class="table table-bordered">
    <thead>
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
            <tr
                class="
    @if ($medicament->isLowStock()) low-stock @endif
    @if ($medicament->isExpired()) expired @endif
    @if (!$medicament->isExpired() && !$medicament->isLowStock()) valid @endif
">
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
                <td>
                    {{ $medicament->code_barre }}
                </td>
                <td>
                    @if ($medicament->supplier)
                        {{ $medicament->supplier->nom }}
                    @else
                        <span class="text-muted">Aucun</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('medicaments.edit', $medicament->id) }}"
                            class="btn btn-sm btn-warning edit-btn">
                            Modifier
                        </a>
                        <form action="{{ route('medicaments.destroy', $medicament->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger delete-btn"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce médicament ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
