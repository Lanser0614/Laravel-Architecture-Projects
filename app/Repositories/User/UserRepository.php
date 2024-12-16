<?php
declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User
    {
        $user->save();
        return $user;
    }

    public function getUserByEmail(string $email): ?User
    {
        return User::query()->where('email', '=', $email)->first();
    }


    public function paginate(int $perPage = 15, int $page = 1): LengthAwarePaginator
    {
        return User::query()->paginate($perPage, ['*'], $page);
    }
}
