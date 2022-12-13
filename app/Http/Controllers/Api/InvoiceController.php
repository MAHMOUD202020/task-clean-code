<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\InvoiceSendEmailJob;
use App\Models\User;
use App\Services\InvoiceService;
use App\Services\UserService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{


    /*
     * start Create Invoice
     * */

    public function create(Request $request){

        $validator = (new InvoiceService())->Validator($request->all()); // Verify that the data sent is correct

        if ($validator->fails()) // check data sent does not comply with the conditions
            return responseApi('error', $validator->errors());

       if ($request->has('user_id') == false):

           $validator = (new UserService())->Validator($request->all()); // Verify that the data sent is correct

           if ($validator->fails()) // check data sent does not comply with the conditions
               return responseApi('error', $validator->errors());

           $user = (new UserService())->createUser($validator->validated());
       else:

           $user = User::find($request->user_id);

           if ($user == null)
               return responseApi('error', __('api.account_not_found'));
       endif;

       $invoice = (new InvoiceService())->create($user, $request);

       InvoiceSendEmailJob::dispatch($user, $invoice);

        return responseApi('success', 'The invoice has been created', $invoice);
    }

    /*
     * end Create Invoice
     * */
}
