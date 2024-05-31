<?php

use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UniversityController;
use App\Models\Material;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $universities = app(UniversityController::class)->index();
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'universities' => $universities,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'materials' => Material::all()->where('user_id', auth()->id())->values(),
        'latestMaterials' => Material::latest()->take(10)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/browse', function (Request $request) {
    $query = $request->input('query');

    $universities = University::query()
        ->withCount('subjects')
        ->when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%');
        })
        ->latest()
        ->paginate(10);

    return Inertia::render('Browse', [
        'universities' => $universities,
        'query' => $query,
    ]);
})->middleware(['auth', 'verified'])->name('browse');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Universities
    Route::get('/universities/create', [UniversityController::class, 'create'])->name('universities.create');
    Route::post('/universities', [UniversityController::class, 'store'])->name('universities.store');
    Route::get('/universities/{university}/edit', [UniversityController::class, 'edit'])->name('universities.edit');
    Route::patch('/universities/{university}', [UniversityController::class, 'update'])->name('universities.update');
    Route::delete('/universities/{university}', [UniversityController::class, 'destroy'])->name('universities.destroy');

    // Subjects
    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');

    // Materials
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::post('materials/{material}/reviews', [MaterialController::class, 'storeReview'])->name('materials.storeReview');
    Route::delete('materials/{material}/comments/{comment}', [MaterialController::class, 'destroyComment'])->name('materials.destroyComment');
    Route::get('/materials/{material}', [MaterialController::class, 'show'])->name('materials.show');
    Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');
});

Route::get('/universities/{university}', [UniversityController::class, 'show'])->name('universities.show');

Route::get('/subjects/{subject}', [SubjectController::class, 'show']);

require __DIR__ . '/auth.php';
