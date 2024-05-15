<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ShowController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.show.index', [
            'shows' => Event::where('type', '=', 'show')->orderBy('date')->get(),
        ]);
    }

    /**
     * @param Event $show
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function edit(Event $show)
    {
        return view('admin.show.edit', [
            'show' => $show,
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function update()
    {
        request()->validate([]);

        return back()->with('success', 'Ordre de passage modifié avec succès.');
    }
}
