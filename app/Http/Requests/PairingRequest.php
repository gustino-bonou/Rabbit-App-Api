<?php

namespace App\Http\Requests;

use App\Rules\ValideFemalRabbit;
use App\Rules\ValideRabbitsInPairing;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PairingRequest extends FormRequest
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
            'pairing_date' => ['required'],
            'observation' => ["string", 'required', 'min:10'],
            'father_id' => ['required','integer','exists:rabbits,id',  new ValideRabbitsInPairing($this->input('father_id'))],
            'mother_id' => ['required','integer', 'exists:rabbits,id', new ValideFemalRabbit($this->input('mother_id'))],
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
