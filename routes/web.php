<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Guide\Buffer;
use App\Models\Guide\Project;
use App\Http\Resources\TagResource;
use App\Http\Resources\NoteResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\LinkResource;
use App\Http\Resources\TopicResource;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\BufferResource;
use App\Http\Resources\ProjectResource;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GuideController;
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
        'topics' => TopicResource::collection($user->topics->keyBy('id')),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/project/{project}', function (Project $project) {
    /** @var User $user */
    $user = auth()->user();
    /** @var Collection $posts */
    $posts = $project->posts->keyBy('id');
    /** @var Collection $tags */
    $tags = $project->tags->keyBy('id');
    /** @var Collection $modules */
    $modules = $project->modules->keyBy('id');
    /** @var Collection $notes */
    $notes = $user->notes()->where('project_id', $project->getKey())
        ->orWhereIn('post_id', $posts->modelKeys())
        ->orWhereIn('module_id', $modules->modelKeys())->get()->keyBy('id');
    $topics = $user->topics()->where('project_id', $project->getKey())
        ->orWhereNull('project_id')->get()->keyBy('id');
    $buffer = $project->buffer ?: Buffer::create(['owner_id' => $user->getKey(), 'project_id' => $project->getKey()]);
    $links = $user->links()
        ->whereIn('note_id', $notes->modelKeys())
        ->orWhereIn('post_id', $posts->modelKeys())
        ->get()->keyBy('id');
    return Inertia::render('Project', [
        'projectId' => $project->getKey(),
        'projects' => ProjectResource::collection([$project->getKey() => $project]),
        'modules' => ModuleResource::collection($modules),
        'topics' => TopicResource::collection($topics),
        'posts' => PostResource::collection($posts),
        'notes' => NoteResource::collection($notes),
        'links' => LinkResource::collection($links),
        'tags' => TagResource::collection($tags),
        'bufferId' => $buffer->getKey(),
        'buffers' => BufferResource::collection([$buffer->getKey() => $buffer])
    ]);
})->middleware(['auth', 'verified'])->name('guide.project');

Route::post('/guide/update', [GuideController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('guide.update');
Route::post('/guide/create', [GuideController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('guide.create');
Route::post('/guide/delete', [GuideController::class, 'delete'])
    ->middleware(['auth', 'verified'])->name('guide.delete');

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
