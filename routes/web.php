<?php

use App\Http\Controllers\GuideController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Guide\Project;
use App\Http\Resources\TopicResource;
use App\Http\Resources\ProjectResource;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('language/{language}', function ($language) {
    /** @var User $user */
    $user = auth()->user();
    $user->updateLanguage($language);

    return redirect()->back();
})->name('language');

Route::get('/dashboard', function () {
    /** @var User $user */
    $user = auth()->user();
    return Inertia::render('Dashboard', [
        'projects' => ProjectResource::collection($user->projects->keyBy('id')),
        'topics' => TopicResource::collection($user->topics->keyBy('id'))
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/project/{project}', function (Project $project) {
    /** @var User $user */
    $user = auth()->user();
    return Inertia::render('Project', [
        'project' => ProjectResource::make($project),
        'topics' => TopicResource::collection($user->topics->keyBy('id'))
    ]);
})->middleware(['auth', 'verified'])->name('guide.project');
Route::post('/guide/update', [GuideController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('guide.update');
Route::post('/guide/create', [GuideController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('guide.create');

Route::get('/game/{process}', [GameController::class, 'process'])
    ->middleware(['auth', 'verified', 'game.visitor'])->name('game');

Route::patch('/game/{user}', [GameController::class, 'turn']);

Route::get('/game/{game}/json', [GameController::class, 'json']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
