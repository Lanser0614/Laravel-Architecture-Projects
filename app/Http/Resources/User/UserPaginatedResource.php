<?php
declare(strict_types=1);

namespace App\Http\Resources\User;

use AutoSwagger\Resources\PaginatedResource;

class UserPaginatedResource extends PaginatedResource
{
    public function initCollection()
    {
        return $this->collection->map(function ($user) {
            return new UserResource($user);
        });
    }
}
