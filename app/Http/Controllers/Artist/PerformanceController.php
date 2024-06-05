<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Performance;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PerformanceController extends Controller
{
    public function index(): Application|\Illuminate\Contracts\View\View|Factory|View|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        return view('artist.performance.index', [
            'user' => $user,
            'performances' => $user->performances()->with('show.event', 'show.event.venue', 'triggerWarnings'),
        ]);
    }

    public function edit(Performance $performance): \Illuminate\Contracts\View\View|Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('artist.performance.edit', ['performance' => $performance]);
    }

    public function update(Request $request, Performance $performance): RedirectResponse
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'description' => ['nullable'],
            'stage_requirements' => ['nullable'],
            'others' => ['nullable'],
            'duration' => ['nullable', 'date_format:H:i:s'],
            'file' => ['nullable'],
        ]);

        $attributes['slug'] = Str::slug($attributes['title']);

        if (request()->hasFile('file')) {
            Storage::delete($performance->file);
            $fileName = $performance->show->event->slug . '_' . $request->user()->username . '_' . $attributes['slug'] . '.' . request()->file('file')->extension();
            $profilePicturePath = request()->file('file')->storeAs('performances/files', $fileName);
            $attributes['file'] = $profilePicturePath;
        }

        $performance->update($attributes);

        return back()->with('success', 'Performance modifiée avec succès.');
    }

}
