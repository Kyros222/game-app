<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Ydb\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function __construct(private readonly UserRepository $users)
    {
    }

    public function __invoke(Request $request)
    {
        $data = request()->validate([
            "login" => "required|string|max:250|min:5",
            "name" => "required|string|min:2|max:255",
            "email" => "required|string|max:255",
            "password" => "required|string|min:8",
        ]);

        if ($this->users->findByLogin($data['login'])) {
            return back()->with('error', 'Пользователь с таким логином уже существует.');
        }

        if ($this->users->findByEmail($data['email'])) {
            return back()->with('error', 'Пользователь с таким email уже существует.');
        }

        $userRow = $this->users->create($data);

        $user = new User();
        $user->forceFill([
            'id' => $userRow['user_id'] ?? null,
            'login' => $userRow['login'] ?? null,
            'name' => $userRow['name'] ?? null,
            'email' => $userRow['email'] ?? null,
            'password' => $userRow['password'] ?? null,
        ]);
        $user->exists = true;

        Auth::login($user);

        return redirect()->route('user', ['user' => $user]);
    }
}
