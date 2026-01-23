<?php

namespace App\Http\Controllers\Trend;

use App\Http\Controllers\Controller;
use App\Models\Trend;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $trends = Trend::orderBy('followers', 'desc')->take(4)->get();
        return view("index", compact('trends'));
    }
}
