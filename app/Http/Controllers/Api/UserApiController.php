<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTOs\User\CreateUserDto;
use App\Exceptions\UserExceptions\UserAlreadyExistException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Resources\User\UserPaginatedResource;
use App\Http\Resources\User\UserResource;
use App\Models\User\User;
use App\Repositories\User\UserRepository;
use App\UseCases\User\StoreUserUseCase;
use AutoSwagger\Attributes\ApiSwagger;
use AutoSwagger\Attributes\ApiSwaggerRequest;
use AutoSwagger\Attributes\ApiSwaggerResponse;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function __construct(
        private readonly StoreUserUseCase $storeUserUseCase,
        private readonly UserRepository $userRepository,
    )
    {
    }

    /**
     * @param UserCreateRequest $request
     * @return User
     * @throws UserAlreadyExistException
     * @throws RequestException
     */
    #[ApiSwagger(summary: 'Store user', tag: 'User')]
    #[ApiSwaggerRequest(request: UserCreateRequest::class, description: 'Store user' )]
    #[ApiSwaggerResponse(status: 200, resource: [
        'id' => 'integer',
        'name' => 'string',
        "email" => "string",
    ])]
    public function store(UserCreateRequest $request): User
    {
        return $this->storeUserUseCase->execute(CreateUserDto::from($request->all()));
    }

    #[ApiSwagger(summary: 'Get all users', tag: 'User')]
    #[ApiSwaggerResponse(status: 200, resource: UserResource::class, isPagination: true)]
    public function index(Request $request): UserPaginatedResource
    {
        $users = $this->userRepository->paginate($request->input('perPage', 10));

        return new UserPaginatedResource($users);
    }
}
