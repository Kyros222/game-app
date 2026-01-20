<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function __invoke(Request $request)
    {

        $data = $request->validate([
            "login" => "required|string|max:250|min:5",
            "password" => "required|string|min:8",
        ]);
        if (Auth::attempt($data)) {
            $user = Auth::user();
            return redirect("/user");
        } else {
            return back()->with('error', 'Проверьте правильность введённых данных.');
        }

    }
}
