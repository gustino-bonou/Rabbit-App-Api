<?php

namespace App\Http\Requests;

use App\Rules\CheckExistenceWeaning;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class WeaningRequest extends FormRequest
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
            "observation" => ['required', 'string', 'min:5'],
            'weaning_date' => ['date', 'required'],
            'whelping_id' => ['integer', 'exists:whelpings,id', new CheckExistenceWeaning($this->input('whelping_id'))],
            'adoption_id' => ['integer', 'exists:adoptions,id', 'nullable'],
            'farm_id' => ['required', 'exists:farms,id'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
            throw new HttpResponseException(response()->json([
                'success' => false,
                "error" => true,
                "message" => "Data not valid",
                "errorsList" => $validator->errors()
            ], 422));
       
    }
}
