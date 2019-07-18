<?php

namespace App\Http\Requests\Dashboard\Balance\Verify;

use Illuminate\Foundation\Http\FormRequest;

class DashboardBalanceVerifyConfirmWithdrawRequest extends FormRequest
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
            'address'=> 'required|string',
            'amount' => 'required|numeric',
            'commission' => 'required|numeric',
            'currency' => 'required|string',
            'confirmation_code' => 'required|digits:6',
        ];
    }
}
