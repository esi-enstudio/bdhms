<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLiftingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'dd_house_id'   => ['required'],
            'products'      => ['required','array'],
            'deposit'       => ['required','numeric','min:1'],
            'itopup'        => ['nullable'],
            'attempt'       => ['required'],
        ];
    }

//    public function messages(): array
//    {
//        return [
//            'dd_house_id' => 'House required',
//        ];
//    }

    public function attributes(): array
    {
        return [
            'dd_house_id' => 'house'
        ];
    }
}
