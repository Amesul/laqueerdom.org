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
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     * Show all the records in the venues table
     */
    public function index()
    {
        return view('admin.venue.index', ['venues' => Venue::all()]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     * Return the view to create a Venue
     */
    public function create()
    {
        return view('admin.venue.create');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     * Create a record in the venues table
     */
    public function store(Request $request)
    {
        $attributes = $this->validateRequest($request);

        Venue::create($attributes);

        return redirect(route('admin.venue.index'))->with('success', 'Structures créé avec succès.');
    }

    /**
     * @param Venue $venue
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     * Return the view to edit the specified Venue
     */
    public function edit(Venue $venue)
    {
        return view('admin.venue.edit', ['venue' => $venue]);
    }

    /**
     * @return RedirectResponse
     * Update specified record in the venues table
     */
    public function update(Request $request, Venue $venue)
    {
        $attributes = $this->validateRequest($request);

        $venue->update($attributes);

        return back()->with('success', 'Structure modifiée avec succès.');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     * Delete specified record in the venues table
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();

        return redirect(route('admin.venues.index'))->with('danger', 'Structure supprimée');
    }

    /**
     * @return array
     * Validate Venue form request
     */
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
