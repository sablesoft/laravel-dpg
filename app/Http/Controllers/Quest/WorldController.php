<?php

namespace App\Http\Controllers\Quest;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Quest\World;
use App\Http\Controllers\Controller;

class WorldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $worlds = World::where('owner_id', Auth::user()->getAuthIdentifier())->get();

        return Inertia::render(
            'QuestJS/World/Index',
            [
                'worlds' => $worlds
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('QuestJS/World/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'desc' => 'sometimes|string',
        ]);

        /** @var World $world */
        $world = World::create([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('slug')),
            'desc' => $request->get('desc'),
        ]);
        $this->createGame($world);

        return redirect()->route('worlds.index')->with('message', 'World Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(World $world): string|RedirectResponse
    {
        if (!$this->checkAccess($world)) {
            return redirect()->route('worlds.index')->with('message', 'You dont have access to this world!');
        }

        return 'Test';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(World $world): Response|RedirectResponse
    {
        if (!$this->checkAccess($world)) {
            return redirect()->route('worlds.index')->with('message', 'You dont have access to this world!');
        }

        return Inertia::render('QuestJS/World/Edit', ['world' => $world]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, World $world): RedirectResponse
    {
        if (!$this->checkAccess($world)) {
            return redirect()->route('worlds.index')->with('message', 'You dont have access to this world!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'desc' => 'sometimes|string',
            'files' => 'sometimes|array',
        ]);

        foreach (['name', 'slug', 'desc', 'files'] as $field) {
            $world->$field = $request->get($field);
        }
        $world->save();

        return redirect()->route('worlds.index')->with('message', 'World Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(World $world): RedirectResponse
    {
        if (!$this->checkAccess($world)) {
            return redirect()->route('worlds.index')->with('message', 'You dont have access to this world!');
        }

        $world->delete();

        return redirect()->route('worlds.index')->with('message', 'World Delete Successfully');
    }

    /**
     * @param World $world
     * @return bool
     */
    protected function checkAccess(World $world): bool
    {
        return $world->owner_id !== Auth::user()->getAuthIdentifierName();
    }

    protected function createGame(World $world): void
    {
        $slug = $world->slug;
        $path = base_path('resources/js/Pages/QuestJS/Game');
        File::makeDirectory($path . "/$slug", 0777);
        $template = File::get($path . '/Template.vue');
        $gameVue = str_replace('// ', '', $template);
        File::put($path . "/$slug/Game.vue", $gameVue);
        foreach (['code', 'data', 'settings'] as $file) {
            File::put($path . "/$slug/$file.js", '');
        }
    }
}
