<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
    use App\Models\Attorney;


class TeamController extends Controller
{

public function index()
{
    $attorneys = Attorney::where('status', 1)
        ->orderBy('sort_order')
        ->get();

    return view('frontend.our-team', compact('attorneys'));
}
}
