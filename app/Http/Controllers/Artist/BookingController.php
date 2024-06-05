<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Show;

class BookingController extends Controller
{
    public function index()
    {
        return view('artist.booking.index', ['shows' => Show::where('applications_open', true)->with('event', 'event.venue')->get()]);
    }

    public function show(Event $event)
    {
        return view('artist.booking.show', ['event' => $event]);
    }
}
