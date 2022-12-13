<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NameController extends Controller
{
    /*
    * # protected #
    * name Validator
    */
    protected function Validator($request)
    {
        return Validator::make($request->all(), [
            'name' => rules('name'),
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

        auth()->user()->update([
            'name' => $request->name
        ]);

        return responseApi('success', __('api.name_change_success'));
    }
}
