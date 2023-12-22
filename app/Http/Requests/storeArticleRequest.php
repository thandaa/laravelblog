<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeArticleRequest extends FormRequest
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
            'title'=>'required|min:4|max:224',
            'body'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'title.requird'=>'pease add title',
            'title.min'=>'min 4 char',
        ];
    }
}
