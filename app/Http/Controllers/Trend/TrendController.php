<?php

namespace App\Http\Controllers\Trend;

use App\Http\Controllers\Controller;
use App\Models\Trend;
use Illuminate\Http\Request;

class TrendController extends Controller
{
    public function __invoke()
    {
        $trends = Trend::orderBy('followers', 'desc')->get();
        return view("trending", compact('trends'));
    }
}
