<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class QuestController extends Controller
{
    /**
     * @param string $code
     * @return Response
     */
    public function run(string $code): Response
    {
        return Inertia::render("QuestJS/$code/Game", []);
    }
}
