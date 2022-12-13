<?php

namespace App\Models;

use App\Enums\CodePhoneStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodePhone extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'code' => 'integer',
        'phone'  => 'integer',
        'type' => CodePhoneStatus::class,
        'expiry'  => 'timestamp',
    ];
}
