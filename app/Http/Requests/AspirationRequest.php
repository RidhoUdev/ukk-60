<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AspirationRequest extends FormRequest
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
        return [
            'category_id' => ['required', 'string', 'exists:categories,id'],
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'min:5'],
            'location' => ['required', 'string', 'min:5', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048']
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.string' => 'Kategori yang dipilih harus berupa teks.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',

            'title.required' => 'Judul laporan wajib diisi',
            'title.string' => 'Judul laporan harus berupa teks.',
            'title.min' => 'Judul laporan yang minimal 5 karakter.',
            'title.max' => 'Judul laporan yang maksimal 255 karakter.',

            'description.required' => 'Deskripsi wajib diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.min' => 'Deskripsi yang minimal 5 karakter.',

            'location.required' => 'Lokasi wajib diisi.',
            'location.string' => 'Lokasi harus berupa teks.',
            'location.min' => 'Lokasi yang minimal 5 karakter.',
            'location.max' => 'Lokasi yang maksimal 255 karakter.',

            'photo.string' => 'File yang diupload harus berupa gambar.',
            'photo.mimes' => 'Gambar yang diupload harus memiliki format png,jpg,jpeg.',
            'photo.max' => 'File gambar maksimal 2MB.',
        ];
    }
}
