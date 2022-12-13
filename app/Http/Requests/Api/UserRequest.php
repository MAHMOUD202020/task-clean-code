<?php

namespace App\Http\Requests\Api;

use App\Enums\PreferredCommunicationChannel;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'name' => ['required', 'string', 'min:4', 'max:20'],
            'email' => ['required', 'email', 'max:100',  'unique:users,email'],
            'phone' => ['required', 'min:7', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:users,phone'],
            'communication_channel' => ['required', 'string', "in:email,phone"]
        ];
    }
}
