<?php

namespace App\Http\Controllers\Trend;

use App\Http\Controllers\Controller;
use App\Services\Ydb\TrendRepository;
use Illuminate\Http\Request;
class CreateController extends Controller
{
    public function __construct(private readonly TrendRepository $trends)
    {
    }

    public function __invoke(Request $request)
    {
        $data = request()->validate([
            "image" => "required|string|min:5",
            "followers" => "required|numeric",
        ]);

        if ($this->trends->existsByImage($data['image'])) {
            return back()->with('error', 'Тренд с таким изображением уже существует.');
        }

        $this->trends->create($data);
        return redirect('/trending');
    }
}
