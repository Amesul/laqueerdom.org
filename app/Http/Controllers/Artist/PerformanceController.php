<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        return Performance::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users'],
            'event_id' => ['required', 'exists:events'],
            'title' => ['required'],
            'description' => ['nullable'],
            'stage_requirements' => ['nullable'],
            'others' => ['nullable'],
            'duration' => ['nullable', 'date'],
            'file' => ['nullable'],
        ]);

        return Performance::create($data);
    }

    public function show(Performance $performance)
    {
        return $performance;
    }

    public function update(Request $request, Performance $performance)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users'],
            'event_id' => ['required', 'exists:events'],
            'title' => ['required'],
            'description' => ['nullable'],
            'stage_requirements' => ['nullable'],
            'others' => ['nullable'],
            'duration' => ['nullable', 'date'],
            'file' => ['nullable'],
        ]);

        $performance->update($data);

        return $performance;
    }

    public function destroy(Performance $performance)
    {
        $performance->delete();

        return response()->json();
    }
}
