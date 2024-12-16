<?php
declare(strict_types=1);

namespace App\Exceptions\Mapper;

use App\Enum\Exception\ExceptionCodeEnum;

class ExceptionCodeMessageMapper
{
    public static function map(int $code): string
    {
        $code = ExceptionCodeEnum::from($code);
        return match ($code) {
            ExceptionCodeEnum::PASSWORD_IS_NOT_HASHED => "Password is not hashed.",
            ExceptionCodeEnum::USER_ALREADY_EXIST => "User already exists.",
            default => "Have not any message.",
        };
    }
}
