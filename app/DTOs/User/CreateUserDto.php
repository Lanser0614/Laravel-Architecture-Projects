<?php
declare(strict_types=1);

namespace App\DTOs\User;

use Spatie\LaravelData\Data;

class CreateUserDto extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    )
    {
    }
}
