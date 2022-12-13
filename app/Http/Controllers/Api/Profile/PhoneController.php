<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class PhoneController extends Controller
{
    /*
    * # protected #
    * name Validator
   */
    protected function Validator($request)
    {
        return Validator::make($request->all(), [
            'phone' => \rules('phone'),
            'password' => rules('password'),
        ]);
    }

    /*
    * name change
    */
    public function change(Request $request)
    {
        $validator = $this->Validator($request); // Verify that the data sent is correct

        if ($validator->fails()) // if the data sent does not comply with the conditions
            return responseApi('error', $validator->errors());

        if (Hash::check($request->password, auth()->user()->password) == false) // Check if the old password matches the password in the database
            return responseApi('error', __('api.current_password_error'));

        auth()->user()->update([
            'phone' => $request->phone
        ]);

        return responseApi('success', __('api.phone_change_success'));
    }
}
