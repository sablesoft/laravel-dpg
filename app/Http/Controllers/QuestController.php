<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class QuestController extends Controller
{
    public function test(): Response
    {
        return Inertia::render('Quest', []);
    }
}
