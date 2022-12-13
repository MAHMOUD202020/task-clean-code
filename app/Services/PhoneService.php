<?php

namespace App\Services;

use App\Models\CodePhone;
use App\Models\User;
use Carbon\Carbon;

class PhoneService
{

    /*
     * View user data by their phone number
     */
    protected function getUserWherePhone($phone)
    {
        return User::where('phone', $phone)->first();
    }

    /*
     *  Show phone number verification code
     */
    protected function getVerificationCode($phone, $type)
    {
        return CodePhone::where('phone', $phone)
            ->where('type', $type)
            ->whereDate('expiry', '>=', Carbon::now())
            ->latest()
            ->first();
    }

    /*
     * Check if the verification code is valid
     */
    public function checkVerificationCode($phone, $type, $code)
    {
        $code_phone  = $this->getVerificationCode($phone, $type);

        return $code_phone ? $code_phone->code == (int)$code : false;
    }

    /*
     * Send a verification code to the user
     */
    protected function saveVerificationCode($phone, $type)
    {
        return  CodePhone::create([
            'code' => random_int(100000 , 900000),
            'phone' => $phone,
            'type' => $type,
            'expiry' => Carbon::now()->addMinutes(10),
        ]);
    }

    /*
    * Send a verification code to the user
    */
    protected function sendVerificationCode($code)
    {

        // api send sms here

        return;
    }

    /*
    * Send a verification code to the user
    */
    public function deleteVerificationCode($phone, $code, $type)
    {
        return  CodePhone::where('phone', $phone)
            ->where('code', $code)
            ->where('type', $type)
            ->delete();
    }


    /*
    * save code and  Send a verification code to the user
    */
    public function SendCode($phone, $type)
    {

        $user = $this->getUserWherePhone($phone);

        if ($type == 'register' && $user !== null) // Check if the phone belongs to one of the site users in status register
            return [ 'status' => 'error', 'message' => __('api.account_exist')];

        if ($type == 'resetPassword' && $user === null) // Check if the phone not found of the site users in status reset password
            return [ 'status' => 'error', 'message' => __('api.account_not_found')];

        if ($this->getVerificationCode($phone, $type)) // Do not send a verification code if there is a verification code already sent
            return ['status' => 'error', 'message' => __('api.verification_already_send')];

        // save code in database
        $code = $this->saveVerificationCode($phone, $type);

        // save code in database and send to user
        $this->sendVerificationCode($code);

        return ['status' => 'success', 'data' => $code];

    }

}
