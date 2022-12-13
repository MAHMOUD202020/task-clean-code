<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    /*
    * # protected #
    * email Validator
    */
    protected function Validator($request)
    {
        return Validator::make($request->all(), [
            'email' => rules('email'),
        ]);
    }

    /*
    * email change
    */
    public function change(Request $request)
    {
        $validator = $this->Validator($request); // Verify that the data sent is correct

        if ($validator->fails()) // if the data sent does not comply with the conditions
            return responseApi('error', $validator->errors());

        auth()->user()->update([
            'email' => $request->email
        ]);

        return responseApi('success', __('api.email_change_success'));
    }
}
