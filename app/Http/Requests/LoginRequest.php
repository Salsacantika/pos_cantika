<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan untuk membuat request ini.
     */
    public function authorize(): bool
    {
        // PERBAIKAN 1: Ubah menjadi true agar request diizinkan masuk
        return true; 
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk request ini.
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Dapatkan pesan kustom untuk error validasi.
     */
    public function messages(): array
    {   
        return [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            // Catatan: Anda bisa menghapus baris di bawah ini jika tidak ada aturan 'min:8' di rules()
            'password.min'      => 'Password minimal :min karakter.', 
        ];
    }
}
