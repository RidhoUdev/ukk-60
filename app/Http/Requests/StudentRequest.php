<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $studentId = $this->route('siswa') ? $this->route('siswa')->id : null;

        return [
            'username' => ['required', 'string', 'min:8', 'max:10', 'unique:users,username,' . $studentId],
            'full_name' => ['required', 'string', 'min:3', 'max:255'],
            'class' => ['required', 'string', 'min:3', 'max:255'],
            'password' => [$this->isMethod('post') ? 'required' : 'nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Nomor Induk Siswa (NIS) wajib diisi.',
            'username.string' => 'Nomor Induk Siswa (NIS) harus berupa teks.',
            'username.min' => 'Nomor Induk Siswa (NIS) minimal 8 karakter.',
            'username.max' => 'Nomor Induk Siswa (NIS) maksimal 10 karakter.',
            'username.unique' => 'Nomor Induk Siswa (NIS) sudah ada.',

            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.string' => 'Nama lengkap harus berupa teks.',
            'full_name.min' => 'Nama lengkap minimal 3 karakter.',
            'full_name.max' => 'Nama lengkap maksimal 255 karakter.',

            'class.required' => 'Kelas wajib diisi.',
            'class.string' => 'Kelas harus berupa teks.',
            'class.min' => 'Kelas minimal 3 karakter.',
            'class.max' => 'Kelas maksimal 255 karakter.',

            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }
}
