<?php
declare(strict_types=1);

namespace App\UseCases\User;

use App\DTOs\User\CreateUserDto;
use App\Exceptions\UserExceptions\UserAlreadyExistException;
use App\HttpServices\SomeService\SomeHttpService;
use App\Models\User\User;
use App\Models\User\ValueObject\UserValueObject;
use App\Repositories\User\UserRepository;
use App\Tasks\User\SaveUserTask;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Hash;

class StoreUserUseCase
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly SaveUserTask   $saveUserTask,
        private readonly SomeHttpService $someHttpService,
    )
    {
    }

    /**
     * @param CreateUserDto $createUserDto
     * @return User
     * @throws UserAlreadyExistException
     * @throws RequestException
     */
    public function execute(CreateUserDto $createUserDto): User
    {
        $user = $this->userRepository->getUserByEmail($createUserDto->email);

        if ($user) {
            throw new UserAlreadyExistException();
        }

        $data = $createUserDto->toArray();
        $data['password'] = Hash::make($createUserDto->password);

        $entity = UserValueObject::from($data);

        $this->someHttpService->getOneItem(1);

        return $this->saveUserTask->run($entity);
    }
}
