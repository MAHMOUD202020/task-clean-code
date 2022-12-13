<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\CodePhoneStatus;
use App\Http\Controllers\Controller;
use App\Services\PhoneService;
use App\Services\UserService;
use App\Traits\JwtToken;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use JwtToken;

    /*
     * send code verification to user
     */
    public function sendCode(Request $request)
    {
        $sendCode = (new PhoneService())->SendCode($request->phone, CodePhoneStatus::register);

        if ($sendCode['status'] == 'error')
            return responseApi('error', $sendCode['message']);

        return responseApi('success', __('api.send_success'), $sendCode['data']['code']/*test*/);

    }

    /*
     * check code verification to user
     */
    public function checkVerificationCode(Request $request)
    {
        $verificationCode = (new PhoneService())->checkVerificationCode($request->phone, CodePhoneStatus::register, $request->code);

        if (empty($request->phone) !== true && $verificationCode !== false)
            return responseApi('success', 'success');

        return responseApi('error', __('api.invalid_code'));
    }


    /*
    * user register account
    */
    public function register(Request $request)
    {

        $validator = (new UserService())->Validator($request->all()); // Verify that the data sent is correct

        if ($validator->fails()) // check data sent does not comply with the conditions
            return responseApi('error', $validator->errors());

        if (($this->checkVerificationCode($request)->status()) != 200) // Verify the validity of the verification code
            return responseApi('error', __('api.invalid_code'));

        (new UserService())->createUser($validator->valid());

        (new PhoneService())->deleteVerificationCode($request->phone, $request->code, CodePhoneStatus::register);

        return responseApi('success', __('api.register_success'), $this->loginAccount($request));
    }

}
