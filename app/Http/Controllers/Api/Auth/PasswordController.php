<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\CodePhoneStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PhoneService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{

    public function sendCode(Request $request){

        $sendCode = (new PhoneService())->sendCode($request->phone, CodePhoneStatus::password);

        if ($sendCode['status'] == 'error')
            return responseApi('error', $sendCode['message']);

        return responseApi('success',  __('api.send_success'), $sendCode['data']['code']/*test*/);
    }

    /*
     * check code verification to user
     */
    public function checkVerificationCode(Request $request)
    {

        $verificationCode = (new PhoneService())->checkVerificationCode($request->phone, CodePhoneStatus::password, $request->code);

        if (empty($request->phone)  !== true && $verificationCode !== false)
            return responseApi('success' , 'success');

        return responseApi('error',  __('api.invalid_code'));

    }

    /*
    * reset password user data Validator
    */
    protected function Validator($request)
    {
        return Validator::make($request->all(), [
            'phone' => \rules('phone'),
        ]);

    }

    public function ResetPassword(Request $request){

        $validator = $this->Validator($request); // Verify that the data sent is correct

        if ($validator->fails()) // check data sent does not comply with the conditions
            return responseApi('error',  $validator->errors());

        if (($this->checkVerificationCode($request)->status()) != 200) // Verify the validity of the verification code
            return responseApi('error',  __('api.invalid_code'));

        User::where('phone', $request->phone)->update([
            'password' => bcrypt($request->password),
        ]);

        (new PhoneService())->deleteVerificationCode($request->phone, $request->code, CodePhoneStatus::password);

        return responseApi('success',  __('api.password_update'));
    }
}
