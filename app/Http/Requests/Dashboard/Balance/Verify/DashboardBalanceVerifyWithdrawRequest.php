<?php

namespace App\Http\Requests\Dashboard\Balance\Verify;

use Illuminate\Foundation\Http\FormRequest;

class DashboardBalanceVerifyWithdrawRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'commission' => 'required|numeric',
            'total' => 'required|numeric',
            'currency' => 'required|string',
        ];
    }
}
