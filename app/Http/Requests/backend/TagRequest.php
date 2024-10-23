<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
        $id = request()->route('tag');
        return [
            'name'=>'required|unique:tags,name,'.$id
        ];
    }
    public function messages():array{
       return 
       [
        'name.required'=>'Tag name is required',
        'name.unique'=>'Tag name must be unique'
       ];
    }
}
