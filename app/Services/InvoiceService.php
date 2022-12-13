<?php

namespace App\Services;

use App\Http\Requests\Api\InvoiceRequest;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;

class InvoiceService
{

    /*
    * create user data Validator
    */
    public function Validator($invoiceData)
    {
        return Validator::make($invoiceData, (new InvoiceRequest())->rules());
    }

    public function create($user , $invoiceData){

        return Invoice::create([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'amount' => $invoiceData->amount,
            'due_date_the_invoice' => $invoiceData->due_date_the_invoice,
            'user_id' => $user->id,
            'admin_id' => auth()->id()
        ]);
    }
}
