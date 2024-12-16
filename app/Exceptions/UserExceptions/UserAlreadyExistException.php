<?php
declare(strict_types=1);

namespace App\Exceptions\UserExceptions;

use App\Enum\Exception\ExceptionCodeEnum;
use App\Exceptions\Mapper\ExceptionCodeMessageMapper;
use App\Exceptions\RestApiException;
use Throwable;

class UserAlreadyExistException extends RestApiException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $code = ExceptionCodeEnum::USER_ALREADY_EXIST->value;
        $message = ExceptionCodeMessageMapper::map($code);
        parent::__construct($message, $code, $previous);
    }
}
