<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.event.index', [
            'events' => Event::with('venue')->orderBy('date')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.event.create');
    }
    public function store(Request $request)
    {
        $attributes = $this->validateRequest($request);

        Event::create($attributes);

        return back()->with('success', 'Événement créé avec succès.');
    }

    public function edit(Event $event)
    {
        return view('admin.event.edit', ['event' => $event]);
    }

    public function update(Request $request, Event $event)
    {
        $attributes = $this->validateRequest($request);

        $event->update($attributes);
        return back()->with('success', 'Événement modifié avec succès.');

    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect(route('admin.events.index'))->with('danger', 'Événement supprimé.');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validateRequest(Request $request): array
    {
        return $request->validate([
            'venue_id' => ['required', 'exists:venues'],
            'title' => ['required'],
            'description' => ['nullable', 'string'],
            'date' => ['required', 'datetime'],
            'price' => ['nullable', 'integer'],
            'thumbnail' => ['nullable'],
            'type' => ['required', 'string'],
        ]);
    }
}
