<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = request()->validate([
            "login" => "required|string|unique:users|max:250|min:5",
            "name" => "required|string|min:2|max:255",
            "email" => "required|string|unique:users|max:255",
            "password" => "required|string|min:8",
        ]);
        
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        Auth::login($user);
        $user = Auth::user();

        return redirect()->route('user', compact('user'));
    }
}
