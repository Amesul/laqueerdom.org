<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class VenueController extends Controller
{
    public function index(): Application|\Illuminate\Contracts\View\View|Factory|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.venue.index', ['venues' => Venue::orderBy('name')->get()]);
    }

    public function create(): Application|\Illuminate\Contracts\View\View|Factory|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.venue.create');
    }

    public function store(Request $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $attributes = $this->validateRequest($request);

        Venue::create($attributes);

        return redirect(route('admin.venues.index'))->with('success', 'Structures créé avec succès.');
    }

    public function edit(Venue $venue): Application|\Illuminate\Contracts\View\View|Factory|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.venue.edit', ['venue' => $venue]);
    }

    public function update(Request $request, Venue $venue): RedirectResponse
    {
        $attributes = $this->validateRequest($request);

        $venue->update($attributes);

        return back()->with('success', 'Structure modifiée avec succès.');
    }

    public function destroy(Venue $venue): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $venue->delete();

        return redirect(route('admin.venues.index'))->with('danger', 'Structure supprimée');
    }

    public function validateRequest(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'address2' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:16'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
        ]);
    }
}
