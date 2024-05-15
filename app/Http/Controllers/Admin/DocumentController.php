<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        return view('admin.documents.index', ['documents' => Document::with('comments')->orderBy('created_at')->get()]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validateRequest($request);
        $attributes['user_id'] = $request->user()->id;

        Document::create($attributes);

        return redirect()->route('admin.documents.index')->with('success', 'Document créé avec succès.');
    }

    public function show(Document $document)
    {
        return view('admin.documents.show', ['document' => $document]);
    }

    public function update(Request $request, Document $document)
    {
        $attributes = $this->validateRequest($request);

        $document->update($attributes);

        return back()->with('success', 'Document modifié avec succès.');
    }

    public function destroy(Document $document)
    {
        $document->delete();

        return redirect()->route('admin.documents.index')->with('danger', 'Document supprimé.');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validateRequest(Request $request): array
    {
        return $request->validate([
            'title' => ['required'],
            'content' => ['required'],
            'type' => ['required'],
        ]);
    }
}
