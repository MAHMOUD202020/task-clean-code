<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\InvoiceSendEmailJob;
use App\Models\User;
use App\Services\InvoiceService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{


    /*
     * start Create user
     * */

    public function create(Request $request){

        $validator = (new UserService())->Validator($request->all()); // Verify that the data sent is correct

        if ($validator->fails()) // check data sent does not comply with the conditions
            return responseApi('error', $validator->errors());

        $user = (new UserService())->createUser($validator->validated());

        return responseApi('success', 'The user has been created', $user);
    }

    /*
     * end Create user
     * */
}
