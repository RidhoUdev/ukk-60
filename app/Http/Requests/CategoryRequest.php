<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $categoryId = $this->route('kategori') ? $this->route('kategori')->id : null;

        return [
            'category_name' => ['required', 'string', 'min:3', 'max:255', 'unique:categories,category_name,' . $categoryId]
        ];
    }

    public function messages()
    {
        return [
            'category_name.required' => 'Nama kategori wajib diisi.',
            'category_name.string' => 'Nama kategori harus berupa teks.',
            'category_name.min' => 'Nama kategori minimal 3 karakter.',
            'category_name.max' => 'Nama kategori maksimal 255 karakter',
            'category_name.unique' => 'Nama kategori sudah ada.'
        ];
    }
}
