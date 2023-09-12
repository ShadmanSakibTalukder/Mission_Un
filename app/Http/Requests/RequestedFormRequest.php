<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestedFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            
            'requested_id' => [
                'required', 'unsignedBigInteger'
            ],
            'part_no' => [
                'required', 'integer'
            ],
            'nomenclature' => [
                'required', 'string'
            ],
            'qty' => [
                'required', 'integer'
            ],
        ];
    }
}
