<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        return Document::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users'],
            'title' => ['required'],
            'content' => ['required'],
            'type' => ['required'],
        ]);

        return Document::create($data);
    }

    public function show(Document $document)
    {
        return $document;
    }

    public function update(Request $request, Document $document)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users'],
            'title' => ['required'],
            'content' => ['required'],
            'type' => ['required'],
        ]);

        $document->update($data);

        return $document;
    }

    public function destroy(Document $document)
    {
        $document->delete();

        return response()->json();
    }
}
