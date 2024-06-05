<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Performance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AdminPerformanceController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'show_id' => 'required',
            'user_id' => 'required',
        ]);

        $attributes['title'] = 'Performance vierge';
        $attributes['slug'] = 'performance_' . Uuid::uuid4();

        Performance::create($attributes);

        return back()->with('success', 'Artiste ajouté.');
    }

    public function destroy($id): RedirectResponse
    {
        $performance = Performance::withTrashed()->find($id);
        if ($performance->deleted_at) {
            $performance->forceDelete();
        } else {
            $performance->delete();
        }
        return back()->with('danger', 'Performance supprimée.');
    }

    public function restore($id): RedirectResponse
    {
        Performance::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'Suppression annulée.');
    }
}
