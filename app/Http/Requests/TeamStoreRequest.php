<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TeamStoreRequest extends FormRequest
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
        return [
            'avatar' => 'required|image',
            'team_name' => 'required|string',
            'administrative_name' => 'required|string',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:team_administrators,email',
            'players' => 'required|array',
            'players.*' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        foreach ($validator->errors() as $error) {

            toastr()->error($error->getMessage());
        }
//        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
