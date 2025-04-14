<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10); // Augmenté à 10 pour le test
        return view('users.index', compact('users'));
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    public function update(UserUpdateRequest $request, User $user)
{
    // Validation est déjà gérée par UserUpdateRequest
    $validated = $request->validated();

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'role' => $validated['role']
    ]);

    return redirect()->route('users.index')
        ->with('success', 'Utilisateur mis à jour avec succès');
}

    public function suspend(Request $request, User $user)
    {
        $user->update(['is_suspended' => !$user->is_suspended]);

        return redirect()->route('users.index')
            ->with('success', 'Statut de l\'utilisateur mis à jour.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')

        ->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function create()
{
    return view('users.create');
}

public function edit(User $user)
{
    return view('users.edit', compact('user'));
}
}
