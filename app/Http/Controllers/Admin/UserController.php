<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', ['users' => User::all()]);
    }

    public function update(Request $request, User $user)
    {
        $user->roles()->attach($request->role);
        return back()->with('success', 'Rôle ajouté avec succès.');
    }

    public function destroy(Request $request, User $user)
    {
        $request->validate(['confirmation' => 'required']);
        if (request('confirmation') == "Supprimer " . $user->username) {
            $user->delete();
            return back()->with('danger', 'Utilisateur supprimé');
        }
        return back()->with('info', 'Échec.');
    }
}
