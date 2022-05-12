<?php

namespace App\Modules\Site\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'address' => 'string|required',
            'coupon' => 'nullable|numeric',
            'phone' => 'numeric|required',
            'email' => 'string|required',
            'total' => 'integer|required',
            'sub_total' => 'integer|required',
            'shipping' => 'numeric|required',
        ];
    }
}
