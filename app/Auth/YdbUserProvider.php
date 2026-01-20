<?php

namespace App\Auth;

use App\Models\User;
use App\Services\Ydb\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;

class YdbUserProvider implements UserProvider
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    public function retrieveById($identifier): ?Authenticatable
    {
        $user = $this->repository->findById((int) $identifier);

        return $user ? $this->mapToModel($user) : null;
    }

    public function retrieveByToken($identifier, $token): ?Authenticatable
    {
        $user = $this->repository->findById((int) $identifier);

        if ($user && ($user['remember_token'] ?? null) === $token) {
            return $this->mapToModel($user);
        }

        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token): void
    {
        $this->repository->updateRememberToken((int) $user->getAuthIdentifier(), $token);
    }

    public function retrieveByCredentials(array $credentials): ?Authenticatable
    {
        $login = $credentials['login'] ?? null;

        if (!$login) {
            return null;
        }

        $user = $this->repository->findByLogin($login);

        return $user ? $this->mapToModel($user) : null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        $plain = $credentials['password'] ?? '';

        return Hash::check($plain, $user->getAuthPassword());
    }

    private function mapToModel(array $data): ?User
    {
        /** @var User $model */
        $model = new User();

        $model->forceFill([
            'id' => $data['user_id'] ?? null,
            'login' => $data['login'] ?? null,
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'password' => $data['password'] ?? null,
            'remember_token' => $data['remember_token'] ?? null,
            'created_at' => $data['created_at'] ?? null,
            'updated_at' => $data['updated_at'] ?? null,
        ]);

        $model->exists = true;

        return $model;
    }
}

