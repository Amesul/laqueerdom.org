<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        $profile = request()->user()->profile;
        $attributes = request()->validate([
            'pseudo' => ['nullable', 'string', 'max:255'],
            'job' => ['nullable', 'string', 'max:255'],
            'link' => ['nullable', 'string', 'max:255'],
            'biography' => ['nullable', 'string', 'max:3000'],
            'pronouns' => ['nullable', 'string', 'max:16'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:102400'],
        ]);

        if (request()->hasFile('profile_picture')) {
            Storage::delete(substr($profile->profile_picture, 9));
            $profilePicturePath = request()->file('profile_picture')->store('profile_pictures');
            $attributes['profile_picture'] = $profilePicturePath;
        }

        $profile->update($attributes);
        return Redirect::route('profile.edit', ['partial' => 'profile'])->with('success', 'Informations du profil modifié.');
    }
}
