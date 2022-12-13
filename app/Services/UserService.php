<?php

namespace App\Services;

use App\Enums\PreferredCommunicationChannel;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserService
{

    /*
    * create user data Validator
    */
    public function Validator($userData)
    {
        return Validator::make($userData, (new UserRequest())->rules());
    }


    /*
     * user register account
     */

    public function createUser($userData)
    {

        $password = array_key_exists('password', $userData)
            ?  $userData['password']
            : Str::random(8);

        $communication_channel = $userData['communication_channel'] ==='email'
            ? PreferredCommunicationChannel::email
            : PreferredCommunicationChannel::phone;

        $data = array_merge($userData, [
            'is_admin' => 0,
            'communication_channel' => $communication_channel,
            'password' => bcrypt($password)
        ]);

        return User::create($data);
    }
}
