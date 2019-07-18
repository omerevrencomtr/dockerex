<?php

namespace App\Http\Requests\Auth\Verify\Login;

use Illuminate\Foundation\Http\FormRequest;

class AuthVerifyLoginPhoneRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'phone_code' => 'required|digits:6',
        ];
    }
}
