<?php

namespace App\Enums;

enum CodePhoneStatus: string
{
    case register = 'register';
    case password = 'resetPassword';
}
