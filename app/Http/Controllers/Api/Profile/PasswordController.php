<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Traits\JwtToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{

    use JwtToken;

    /*
    * # protected #
    * old password and new password Validator
    */
    protected function Validator($request)
    {
        return Validator::make($request->all(), [
            'old_password' => rules('password'),
            'new_password' => rules('password'),
        ]);
    }

    /*
    * # protected #
    * get user
    */
    protected function user()
    {
        return auth()->user();
    }

    /*
    * password change
    */
    public function change(Request $request)
    {

        $validator = $this->Validator($request); // Verify that the data sent is correct

        if ($validator->fails()) // if the data sent does not comply with the conditions
            return responseApi('error', $validator->errors());

        if (!Hash::check($request->old_password, $this->user()->password)) // Check if the old password matches the password in the database
            return responseApi('error', __('api.old_password_error'));

       $newToken =  $this->password_change($request);

        return responseApi('success', __('api.password_change_success'), $newToken);
    }

    /////////////////////////////////////////// clean code /////////////////////////

    private function password_change ($request){
        $this->user()->update([ // update password
            'password' => bcrypt($request->new_password)
        ]);

        return $this->apiRefresh(); // refresh token after update password

    }
}
