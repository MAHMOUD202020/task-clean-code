<?php

namespace App\Traits\User;

use Illuminate\Support\Facades\DB;

trait ScopeTrait
{

    public function admin($q){
        return $q->where('is_admin', 1);
    }

    public function user($q){
        return $q->where('is_admin', 0);
    }
}
