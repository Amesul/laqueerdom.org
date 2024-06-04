<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|View
    {
        return view('artist.applications.index', ['applications' => Application::with('show', 'show.event', 'show.event.venue')->where('user_id', auth()->id())->simplePaginate(25)]);
    }

    public function create()
    {
        return view('artist.applications.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'user_id' => ['required', 'exists:users'],
            'event_id' => ['required', 'exists:events'],
            'description' => ['required'],
            'accepted' => ['nullable', 'boolean'],
        ]);

        return Application::create($attributes);
    }

    public function show(Application $application): Application
    {
        return $application;
    }

}
