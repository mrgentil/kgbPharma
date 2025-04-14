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
            <button class="btn btn-sm btn-warning edit-btn"
                data-id="{{ $user->id }}"
                data-name="{{ $user->name }}"
                data-email="{{ $user->email }}"
                data-role="{{ $user->role }}"
                data-bs-toggle="modal"
                data-bs-target="#editUserModal">Modifier</button>

            <button class="btn btn-sm btn-secondary suspend-btn"
                data-id="{{ $user->id }}"
                data-status="{{ $user->is_suspended }}"
                data-bs-toggle="modal"
                data-bs-target="#suspendUserModal">Suspendre</button>

            <button class="btn btn-sm btn-danger delete-btn"
                data-id="{{ $user->id }}"
                data-bs-toggle="modal"
                data-bs-target="#deleteUserModal">Supprimer</button>
        </div>
    </td>
</tr>
