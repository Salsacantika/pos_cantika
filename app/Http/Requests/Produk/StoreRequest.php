<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jenis_id' => 'required|exists:jenis,id',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'nama' => 'required|string|max:255',
            'harga_beli' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'jenis_id.required' =>'Jenis produk wajib dipilih.',
            'jenis_id.exists' =>'Jenis produk tidak valid.',
            'foto.required' => 'Foto produk wajib dipilih.',
            'foto.image' => 'File yang diupload harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',

            'nama.required' => 'Nama produk wajib diisi.',
            'nama.string' => 'Nama produk harus berupa teks.',
            'nama.max' => 'Nama produk maksimal 255 karakter.',

            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.integer' => 'Harga beli harus berupa angka bulat.',

            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.integer' => 'Harga jual harus berupa angka bulat.',

            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka bulat.',
        ];
    }
}