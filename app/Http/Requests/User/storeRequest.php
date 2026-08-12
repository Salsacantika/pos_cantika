<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jenis_id'   => 'required|exists:jenis,id',
            'nama'       => 'required|string|max:255',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok'       => 'required|integer|min:0',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'jenis_id.required'   => 'Jenis produk wajib dipilih.',
            'jenis_id.exists'     => 'Jenis produk yang dipilih tidak valid.',
            'nama.required'       => 'Nama produk wajib diisi.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'stok.required'       => 'Stok wajib diisi.',
            'foto.image'          => 'File yang diunggah harus berupa gambar.',
            'foto.max'            => 'Ukuran foto maksimal adalah 2MB.',
        ];
    }
}