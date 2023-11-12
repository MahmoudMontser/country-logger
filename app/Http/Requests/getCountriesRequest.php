<?php

namespace App\Http\Requests;

use App\Domains\Shared\v1\Exception\ApiValidationException;
use App\Http\Resources\CountryResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class getCountriesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules=[
            'callback_url'=>['nullable','url'],
            'password'=>['required','string']
        ];
        return $rules;
    }
    public function failedValidation(Validator $validator) {
        $errors = $validator->errors();
        throw new HttpResponseException( response()->json(['errors'=>$errors,'status'=>true],422));
    }
}
