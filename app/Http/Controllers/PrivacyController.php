<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class PrivacyController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function __invoke(): RedirectResponse
    {
        request()->user()->update(request()->validate([
            'privacy' => 'string|required'
        ]));

        return back()->with('success', 'Paramètres de confidentialités modifiés.');
    }
}
