<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        return [
            'code' => ['required', 'string', 'max:191', 'unique:App\Models\Product,code'],
            'name' => ['required', 'string', 'max:191'],
            'category' => ['required', 'string', 'max:191'],
            'brand' => ['nullable', 'string', 'max:191'],
            'type' => ['nullable', 'string', 'max:191'],
            'description' => ['nullable', 'string', 'max:10000'],
        ];
    }
}
