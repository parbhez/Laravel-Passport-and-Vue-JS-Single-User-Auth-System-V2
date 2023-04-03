<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $id = $this->request->get('id') ?? null;

        return [
            'category_name' => 'required|min:3|unique:categories,category_name,' . $id,
        ];
    }

     /**
     * Get the validation message from by default laravel and show the message for user.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function failedValidation(Validator $validator): array
    {
        throw new HttpResponseException(respondError(VALIDATION_ERROR, $validator->errors(), 422));
    }

     /**
     * Set the validation Custom message and show the message for user.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function messages(): array
    {
        return [

        ];
    }

    /**
     * persist from data
     * @return array
     */

     public function persist(): array
     {
        return $data = [
           'category_name' => $this->category_name,
           'remarks' => $this->remarks,
           'status' => $this->status,
        ];
     }

}
