<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistreUserRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'min:5'],
            'last_name' => ['required', 'string', 'min:5'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email' , 'unique:users,email'],
            'password' => ['required']
        ];
    }
<<<<<<< HEAD

=======
>>>>>>> faf425a875954cabec560cea5539e70460a61b4c
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
