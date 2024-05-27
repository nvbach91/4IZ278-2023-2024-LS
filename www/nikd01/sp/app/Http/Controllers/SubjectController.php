<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\University;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectController extends Controller
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
        return Inertia::render('Subject/Create', [
            'universities' => University::query()->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'university_id' => ['required'],
            'name' => ['required', 'max:255'],
            'code' => ['required', 'max:10'],
            'description' => ['required', 'max:255'],
        ]);

        Subject::create($request->all());

        return redirect('/universities/' . $request->university_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $subject->load(['materials', 'materials.ratings']);
        return Inertia::render('Subject/Index', [
            'subject' => $subject,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
