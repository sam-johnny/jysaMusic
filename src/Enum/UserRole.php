<?php

namespace App\Enum;

enum UserRole: string
{
    case ARTIST = 'ROLE_ARTIST';
    case READER = 'ROLE_READER';
    case ADMIN = 'ROLE_ADMIN';
    case USER = 'ROLE_USER';
}