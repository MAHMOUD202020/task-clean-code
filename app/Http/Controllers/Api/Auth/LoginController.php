<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\JwtToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use JwtToken;

    /*
     * login user data Validator
     */
    protected function Validator($request)
    {
        return Validator::make($request->all(), [

            'phone' => rules('phone'),
            'password' => rules('password'),
        ]);

    }

    /*
     * login user action
     */
    public function login(Request $request)
    {

        $validator = $this->Validator($request); // Verify that the data sent is correct

        if ($validator->fails()) // if the data sent does not comply with the conditions
            return responseApi('error', $validator->errors());

        if (!$token = $this->loginAccount($request)) // if the account information does not match
            return responseApi('unauthorized', __('api.unauthorized'));

        return responseApi('success', '', $token);
    }



}
