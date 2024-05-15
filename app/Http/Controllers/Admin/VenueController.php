<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index()
    {
        return view('admin.venue.index', ['venues' => Venue::all()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'address' => ['required'],
            'address2' => ['nullable'],
            'zip_code' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
        ]);

        return Venue::create($data);
    }

    public function show(Venue $venue)
    {
        return $venue;
    }

    public function update(Request $request, Venue $venue)
    {
        $data = $request->validate([
            'name' => ['required'],
            'address' => ['required'],
            'address2' => ['nullable'],
            'zip_code' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
        ]);

        $venue->update($data);

        return $venue;
    }

    public function destroy(Venue $venue)
    {
        $venue->delete();

        return response()->json();
    }
}
