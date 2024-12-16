<?php
declare(strict_types=1);

namespace App\Models\User\ValueObject;

use App\Exceptions\UserExceptions\PasswordIsNotHashedException;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;

class UserValueObject extends Data
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param int|null $id
     * @throws PasswordIsNotHashedException
     */
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly ?int   $id,
    )
    {
        if (!Hash::isHashed($this->password)) {
            throw new PasswordIsNotHashedException();
        }
    }
}
