<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'product_sku'   => 'required|unique:products,product_sku',
            'product_name'  => 'required|unique:products,product_name',
            'category'      => 'required|exists:categories,id',
            'status'        => 'required|in:0,1',
        ];
    }
}
