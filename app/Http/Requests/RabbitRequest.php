<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RabbitRequest extends FormRequest
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
            'name' => ["string", 'required'],
            'description' => ["string", 'nullable'],
            'race' => ["string", 'nullable'],
            'image' => ["string", 'nullable'],
            'gender' => ["string", 'required', 'in:Mal,Femelle'],
            'whelping_date' => ['nullable'],  
            'adoption_id' => ['nullable', "exists:adoptions,id"],
            'weaning_id' => ['nullable', "exists:weanings,id"],
            'whelping_id' => ['nullable', "exists:whelpings,id"],
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
