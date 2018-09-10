<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCategoryRequest extends FormRequest
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
                'id' => 'exists:categories,id',
                'name' => 'required|unique:categories,name,' . $this->id,
               
            ];
        
    }
    public function messages()
    {
        return [
            'name.required' => 'Category name  Is Required',
            'name.unique' => 'this name is already exist ',
          
        ];
    }
}
