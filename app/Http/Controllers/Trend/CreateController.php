<?php

namespace App\Http\Controllers\Trend;

use App\Http\Controllers\Controller;
use App\Models\Trend;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = request()->validate([
            "image" => "required|string|min:5|unique:trends",
            "followers" => "required|numeric",
        ]);

        $trend = Trend::create($data);
        return redirect('/trending');
    }
}
