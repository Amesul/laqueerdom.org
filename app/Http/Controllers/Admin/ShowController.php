<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Performance;
use App\Models\Show;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Ramsey\Uuid\Uuid;

class ShowController extends Controller
{
    public function index(): Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View|Application
    {
        return view('admin.show.index', [
            'shows' => Show::with('event', 'applications', 'event.venue')->get()->sortByDesc('event.date'),
        ]);
    }

    public function edit(Show $show): Factory|\Illuminate\Foundation\Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.show.edit', ['show' => $show]);
    }

    public function toggleApplications(Show $show): RedirectResponse
    {
        $show->update([
            'applications_open' => !$show->applications_open
        ]);

        if ($show->applications_open === true) {
            // TODO: Send mail to artists
        }

        $message = $show->applications_open ? 'ouvertes' : 'fermées';
        return back()->with($show->applications_open ? 'success' : 'danger', "Candidatures $message.");
    }

    public function update(Show $show): RedirectResponse
    {
        $attributes = request()->validate(['deadline' => 'required|date']);

        $show->update($attributes);

        return back()->with('success', 'Deadline modifiée');
    }

    public function editPerformances(Show $show): Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.show.edit-performances', [
            'show' => $show,
            'users' => User::with('profile')->orderBy('name')->get()->sortBy('profile.pseudo'),
            'performances' => Performance::withTrashed()->with('user', 'user.profile', 'triggerWarnings')->where('show_id', '=', $show->id)->orderBy('order')->get(),
        ]);
    }

    public function showPerformance(Show $show, Performance $performance): Factory|\Illuminate\Foundation\Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.show.show-performance', [
            'show' => $show,
            'performance' => $performance->load('user', 'user.profile', 'triggerWarnings')
        ]);
    }

    public function editApplications(Show $show): \Illuminate\Foundation\Application|View|Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.show.edit-applications', [
            'show' => $show,
            'applications' => Application::with('user', 'user.profile')->where('show_id', '=', $show->id)->get(),
        ]);
    }

    public function updatePerformances(): string
    {
        $performances = request()->validate(['performances' => 'required', 'array'])['performances'];
        foreach ($performances as $performance) {
            Performance::find($performance['id'])
                ->update([
                    'order' => intval($performance['order'])
                ]);
        }

        return 'Performances updated.';
    }

    public function updateApplication(Application $application): RedirectResponse
    {
        $attributes = request()->validate(['accepted' => 'required']);
        $attributes['accepted'] = boolval($attributes['accepted']);

        $application->update($attributes);

        if ($attributes["accepted"]) {
            Performance::create([
                'show_id' => $application->show->id,
                'user_id' => $application->user->id,
                'slug' => 'performance_' . Uuid::uuid4(),
                'title' => 'Performance vierge',
            ]);
        }

        $status = $attributes["accepted"] ? 'success' : 'danger';
        $message = $attributes["accepted"] ? 'Candidature acceptée.' : 'Candidature refusée.';

        return back()->with($status, $message);
    }
}
