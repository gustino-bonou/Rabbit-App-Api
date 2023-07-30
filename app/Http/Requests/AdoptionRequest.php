<?php

namespace App\Http\Requests;

use App\Rules\ValideFemalRabbit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdoptionRequest extends FormRequest
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
            'adoption_date' => ["date", 'required'],
            'observation' => ["string", 'required', 'min:10'],
            'adoption_mother' => ['required','integer','exists:rabbits,id', new ValideFemalRabbit($this->input('adoption_mother'))],
            'whelping_id' => ['nullable', 'exists:whelpings,id']
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
