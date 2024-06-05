<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Show;
use App\Models\Venue;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): Factory|\Illuminate\Contracts\View\View|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.event.index', [
            'events' => Event::with('venue')->orderBy('date', 'desc')->get(),
        ]);
    }

    public function create(): Factory|\Illuminate\Contracts\View\View|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.event.create', [
            'venues' => Venue::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $this->validateRequest($request);

        $event = Event::create($attributes);

        if ($attributes['type'] === 'show') {
            Show::create([
                'event_id' => $event->id,
                'applications_open' => false,
            ]);
        }

        return redirect(route('admin.events.index'))->with('success', 'Événement créé avec succès.');
    }

    public function edit(Event $event): Factory|\Illuminate\Contracts\View\View|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.event.edit', [
            'event' => $event,
            'venues' => Venue::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $attributes = $this->validateRequest($request);

        if ($request->hasFile('thumbnail')) {
            Storage::delete(substr($event->thumbnail, 9));
        }

        // Prevent update on type column
        $attributes['type'] = $event->type;

        $event->update($attributes);
        return redirect(route('admin.events.edit', $event))->with('success', 'Événement modifié avec succès.');
    }

    public function destroy(Event $event): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $event->delete();
        return redirect(route('admin.events.index'))->with('danger', 'Événement supprimé.');
    }

    public function validateRequest(Request $request): array
    {
        $attributes = $request->validate([
            'venue_id' => ['required', 'exists:venues,id'],
            'title' => ['required'],
            'description' => ['nullable', 'string'],
            'date' => ['required', 'date'],
            'price' => ['nullable', 'integer'],
            'thumbnail' => ['nullable'],
            'type' => ['required', 'string'],
        ]);

        $attributes['slug'] = Str::slug($attributes['title']);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails');
            $attributes['thumbnail'] = $thumbnailPath;
        }

        return $attributes;
    }
}
