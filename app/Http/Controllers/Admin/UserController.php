<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     */
    public function index(): Application|\Illuminate\Contracts\View\View|Factory|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.index', ['users' => User::with(['profile', 'roles'])->orderBy('username')->get()]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $attributes = $request->validate([
            'add_roles' => 'nullable',
            'remove_role' => 'nullable',
        ]);

        if (isset($attributes['add_roles'])) {
            $roles = explode(',', $attributes['add_roles']);

            foreach ($roles as $role) {
                $user->roles()->attach($role);
            }

            return back()->with('success', 'Rôle(s) ajouté(s) avec succès.');
        } elseif (isset($attributes['remove_role'])) {
            $user->roles()->detach($attributes['remove_role']);

            return back()->with('success', 'Rôle retiré avec succès.');
        }
        return back()->with('danger', 'Échec lors de la modification des rôles.');
    }
}
