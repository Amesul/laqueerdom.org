<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventUserController extends Controller
{
    public function index()
    {
        return view('artist.event.index', ['events' => Auth::user()->events]);
    }

    public function show(Event $event)
    {
        return view('artist.event.show', ['event' => $event]);
    }
}

