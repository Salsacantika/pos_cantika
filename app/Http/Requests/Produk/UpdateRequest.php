<?php

namespace App\Http\Requests\Produk;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama' => 'required|string|max:255',
            'harga_beli' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'foto.image'           => 'File yang diupload harus gambar.',
            'foto.mimes'           => 'Extensi gambar harus JPG, JPEG, PNG.',
            'foto.max'             => 'Maksimal ukuran gambar 2MB.',
            'nama.required'        => 'Nama wajib diisi.',
            'nama.string'          => 'Nama harus berupa teks.',
            'nama.max'             => 'Nama maksimal 255 karakter.',
            'harga_beli.required'  => 'Harga beli wajib diisi.',
            'harga_beli.integer'   => 'Harga beli harus diisi bilangan bulat.',
            'harga_beli.min'       => 'Harga beli tidak boleh kurang dari 0.',
            'harga_jual.required'  => 'Harga jual wajib diisi.',
            'harga_jual.integer'   => 'Harga jual harus diisi bilangan bulat.',
            'harga_jual.min'       => 'Harga jual tidak boleh kurang dari 0.',
            'stok.required'        => 'Stok wajib diisi.',
            'stok.integer'         => 'Stok harus diisi angka.',
            'stok.min'             => 'Stok tidak boleh kurang dari 0.',
        ];
    }
}