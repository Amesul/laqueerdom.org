<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Performance;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PerformanceController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     */
    public function index()
    {
        return view('artist.performance.index', ['performances' => Auth::user()->performances()]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $this->validateRequest($request);

        $attributes['user_id'] = Auth::id();

        Performance::create($attributes);

        return redirect()->route('artist.performance.index')->with('success', 'Performance créée avec succès.');
    }

    /**
     * @param Performance $performance
     * @return Application|Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\View|View
     */
    public function edit(Performance $performance)
    {
        return view('artist.performance.edit', ['performance' => $performance]);
    }

    /**
     * @param Request $request
     * @param Performance $performance
     * @return RedirectResponse
     */
    public function update(Request $request, Performance $performance)
    {
        $attributes = $this->validateRequest($request);

        $performance->update($attributes);

        return back()->with('success', 'Performance modifiée avec succès.');
    }

    /**
     * @param Performance $performance
     * @return RedirectResponse
     */
    public function destroy(Performance $performance)
    {
        $performance->delete();

        return redirect()->route('artist.performance.index')->with('danger', 'Performance supprimée.');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validateRequest(Request $request): array
    {
        return $request->validate([
            'event_id' => ['required', 'exists:events'],
            'title' => ['required'],
            'description' => ['nullable'],
            'stage_requirements' => ['nullable'],
            'others' => ['nullable'],
            'duration' => ['nullable', 'date_format:i:s'],
            'file' => ['nullable'],
        ]);
    }
}
