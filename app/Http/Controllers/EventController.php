<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'venue_id' => ['required', 'exists:venues'],
            'title' => ['required'],
            'description' => ['required'],
            'date' => ['required', 'date'],
            'price' => ['required', 'integer'],
            'thumbnail' => ['required'],
            'type' => ['required'],
        ]);

        return Event::create($data);
    }

    public function show(Event $event)
    {
        return $event;
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'venue_id' => ['required', 'exists:venues'],
            'title' => ['required'],
            'description' => ['required'],
            'date' => ['required', 'date'],
            'price' => ['required', 'integer'],
            'thumbnail' => ['required'],
            'type' => ['required'],
        ]);

        $event->update($data);

        return $event;
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json();
    }
}
