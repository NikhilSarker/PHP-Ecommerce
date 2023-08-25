<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category'=> 'required',
            'subcategory'=> 'required',
            'product_name'=> 'required',
            'price'=> 'required',
            'long_description'=> 'required',
            'preview_image'=> 'required | image',
            // 'gallery_image'=> 'required | image',
        ];
    }
    public function messages(): array
    {
        return [
            'category.required'=> 'Please select category name',
            'subcategory.required'=>  'Please select subcategory name',
            // 'product_name'=> 'required',
            // 'price'=> 'required',
            // 'tags[]'=> 'required',
            // 'preview_image'=> 'required | image',
            // 'gallery_image'=> 'required | image',
        ];
    }
}
