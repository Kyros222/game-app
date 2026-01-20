<?php

namespace App\Http\Controllers\Trend;

use App\Http\Controllers\Controller;
use App\Services\Ydb\TrendRepository;

class IndexController extends Controller
{
    public function __construct(private readonly TrendRepository $trends)
    {
    }

    public function __invoke()
    {
        $trends = collect($this->trends->top(4))->map(fn ($row) => (object) $row);
        return view("index", compact('trends'));
    }
}
