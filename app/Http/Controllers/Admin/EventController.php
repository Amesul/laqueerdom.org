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
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     */
    public function index()
    {
        return view('admin.event.index', [
            'events' => Event::with('venue')->orderBy('date', 'desc')->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
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

    /**
     * @param Request $request
     * @return array
     */
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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     */
    public function create()
    {
        return view('admin.event.create', [
            'venues' => Venue::orderBy('name')->get(),
        ]);
    }

    /**
     * @param Event $event
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     */
    public function edit(Event $event)
    {
        return view('admin.event.edit', [
            'event' => $event,
            'venues' => Venue::orderBy('name')->get(),
        ]);
    }

    /**
     * @param Request $request
     * @param Event $event
     * @return RedirectResponse
     */
    public function update(Request $request, Event $event)
    {
        $attributes = $this->validateRequest($request);

        if ($request->hasFile('thumbnail')) {
            Storage::delete(substr($event->thumbnail, 9));
        }

        // Prevent update on type column
        $attributes['type'] = $event->type;

        if ($attributes['type'] === 'show') {
            Show::create([
                'event_id' => $event->id,
                'applications_open' => false,
            ]);
        }

        $event->update($attributes);
        return back()->with('success', 'Événement modifié avec succès.');
    }

    /**
     * @param Event $event
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect(route('admin.events.index'))->with('danger', 'Événement supprimé.');
    }
}
