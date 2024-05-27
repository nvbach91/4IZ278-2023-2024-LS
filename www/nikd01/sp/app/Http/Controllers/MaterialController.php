<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Material;
use App\Models\Subject;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Materials/Create', [
            'universities' => University::query()->latest()->get(),
            'subjects' => Subject::query()->latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file', 'max:2048'],
        ]);

        $disk = 'materials';
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $userId = auth()->user()->id;
        $filepath = '/' . $userId . '/' . $filename;

        Storage::disk($disk)->put($filepath, file_get_contents($file));

        $url = 'https://study-sync.s3.amazonaws.com/' . $disk . $filepath;

        Material::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $url,
            'user_id' => $userId,
            'subject_id' => $request->subject_id,
        ]);

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        $material->load(['comments.user', 'ratings.user']);
        return Inertia::render('Materials/Show', [
            'material' => $material,
            'canDelete' => auth()->user()->can('delete', $material)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material, Request $request)
    {
        if ($request->user()->cannot('delete', $material)) {
            abort(403, 'Unauthorized action.');
        }
        $material->delete();
        return redirect()->route('dashboard')->with('success', 'Material deleted successfully');
    }

    /**
     * Store a newly created review (rating and comment) for a material.
     */
    public function storeReview(Request $request, Material $material)
    {
        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'content' => ['nullable', 'string', 'max:255'],
        ]);

        $material->ratings()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
        ]);

        if ($request->filled('comment_text')) {
            $material->comments()->create([
                'user_id' => auth()->id(),
                'comment_text' => $request->comment_text,
            ]);
        }

        return redirect()->route('materials.show', $material);
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroyComment(Material $material, Comment $comment)
    {
        if (auth()->user()->cannot('delete', $comment)) {
            abort(403, 'Unauthorized action.');
        }
        $comment->delete();
        return redirect()->route('materials.show', $material)->with('success', 'Comment deleted successfully');
    }

}
