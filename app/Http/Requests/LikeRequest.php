<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\JsonResponse;
class LikeRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tweet_id' => 'required|exists:tweets,id',
        ];
    }

    public function attributes()
    {
        return [

        ];
    }

    public function messages()
    {
       return [

       ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        $response = new JsonResponse([
                'data' => [],
                'errors' =>  $validator->errors(),
             ], 422);

    throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
