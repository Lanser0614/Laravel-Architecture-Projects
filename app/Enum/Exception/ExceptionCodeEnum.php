<?php

namespace App\Enum\Exception;

enum ExceptionCodeEnum: int
{
    case PASSWORD_IS_NOT_HASHED = 601;
    case USER_ALREADY_EXIST = 602;


}
