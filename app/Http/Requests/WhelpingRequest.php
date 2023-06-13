<?php

namespace App\Http\Requests;

use App\Rules\CheckExistenceWhelping;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class WhelpingRequest extends FormRequest
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
                'whelping_date' => ['date', 'required'],
                'pairing_id' => ['integer', 'exists:pairings,id', new CheckExistenceWhelping($this->input('pairing_id'))],
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
