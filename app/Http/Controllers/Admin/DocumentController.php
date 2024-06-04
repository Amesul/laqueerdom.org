<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DocumentController extends Controller
{
    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.documents.index', ['documents' => Document::with('comments', 'comments.user')->orderBy('created_at')->get()]);
    }


    public function create(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.documents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $this->validateRequest($request);
        $attributes['user_id'] = $request->user()->id;

        Document::create($attributes);

        return redirect()->route('admin.documents.index')->with('success', 'Document créé avec succès.');
    }

    public function show(Document $document): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.documents.show', ['document' => $document, 'comments' => $document->comments->load('user')->sortBy('created_at')]);
    }

    public function edit(Document $document): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('admin.documents.edit', ['document' => $document]);
    }

    public function update(Request $request, Document $document): RedirectResponse
    {
        $attributes = $this->validateRequest($request, $document);

        $document->update($attributes);

        return back()->with('success', 'Document modifié avec succès.');
    }

    public function destroy(Document $document): RedirectResponse
    {
        $document->delete();

        return redirect()->route('admin.documents.index')->with('danger', 'Document supprimé.')->withInput();
    }

    public function validateRequest(Request $request, Document $document = null): array
    {
        $attributes = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('documents', 'title')->ignore($document)],
            'content' => ['nullable', 'string'],
            'type' => ['required'],
        ]);
        $attributes['slug'] = Str::slug($attributes['title']);

        return $attributes;
    }
}
