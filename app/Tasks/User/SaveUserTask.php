<?php
declare(strict_types=1);

namespace App\Tasks\User;

use App\Models\User\User;
use App\Models\User\ValueObject\UserValueObject;
use App\Repositories\User\UserRepository;

class SaveUserTask
{
    public function __construct(
      private readonly UserRepository $userRepository,
    )
    {
    }

    /**
     * @param UserValueObject $userValueObject
     * @return User
     */
    public function run(UserValueObject $userValueObject): User
    {
        $user = new User();
        $user->name = $userValueObject->name;
        $user->email = $userValueObject->email;
        $user->password = $userValueObject->password;
        return $this->userRepository->save($user);
    }
}
