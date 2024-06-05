<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): View
    {
        return view('artist.applications.index', [
            'applications' => Application::with('show', 'show.event', 'show.event.venue')->where('user_id', auth()->id())->orderByDesc('created_at')->simplePaginate(25)
        ]);
    }

    public function create(): View
    {
        $applied = Auth::user()->applications()
            ->leftJoin('shows', 'shows.id', '=', 'applications.show_id')
            ->pluck('shows.id')
            ->toArray();

        $shows = Show::with('event')->where('applications_open', '=', true)->get()
            ->reject(function ($value) use ($applied) {
                return in_array($value->id, $applied);
            });

        return view('artist.applications.create', [
            'shows' => $shows,
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'show_id' => ['required', 'exists:shows,id'],
            'description' => ['required', 'string'],
        ]);

        $attributes['user_id'] = auth()->id();

        Application::create($attributes);

        return redirect(route('artist.applications.index'))->with('success', 'Candidature envoyée.');
    }

}
