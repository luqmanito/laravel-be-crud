<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        if ($this->method() == 'POST') {
            return true;
        } else {
            return $this->product->business_id == Auth::user()->business_id;
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'code' => [
                'required',
                'string',
                'max:16',
                Rule::unique(Product::class)
                    ->where('business_id', Auth::user()->business_id)
                    ->ignore($this->product),
            ],
            'description' => 'required|string|min:10',
            'price' => 'required|numeric',

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return Product
     */
    public function persist(Product $product = null)
    {

        $product = $product ?? new Product();
        $product->name = $this->name;
        $product->code = $this->code;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->business_id = auth()->user()->business_id;

        $product->save();

        return $product->fresh()->load(['business']);
    }
}
