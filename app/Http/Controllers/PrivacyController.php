<?php

namespace App\Http\Controllers;

class PrivacyController extends Controller
{
    public function __invoke()
    {
        request()->user()->update(request()->validate([
            'privacy' => 'string|required'
        ]));

        return back()->with('success', 'Paramètres de confidentialités modifiés.');
    }
}
