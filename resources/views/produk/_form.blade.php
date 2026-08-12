@extends('layouts.app') {{-- Sesuaikan dengan layout utama aplikasi Anda jika ada --}}

@section('content')
<div class="container-fluid px-4 py-4">

    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <h4 class="fw-bold mb-4" style="color: #1a1a1a;">Tambah Produk Baru</h4>

        {{-- FORM UTAMA PEMBUNGKUS --}}
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Style Khusus Form Elegan --}}
            <style>
                :root {
                    --maison-brown: #a26b4e;
                    --maison-brown-hover: #8c5a40;
                    --maison-text: #1a1a1a;
                    --maison-border: #e2e8f0;
                }

                .form-label-luxury {
                    color: var(--maison-text);
                    font-weight: 700;
                    font-size: 0.8rem;
                    letter-spacing: 1px;
                    text-transform: uppercase;
                    margin-bottom: 8px;
                }

                .input-group-luxury {
                    background-color: #f8fafc;
                    border-radius: 16px;
                    border: 1.5px solid var(--maison-border);
                    overflow: hidden;
                    transition: all 0.3s ease;
                }

                .input-group-luxury:focus-within {
                    border-color: var(--maison-brown);
                    box-shadow: 0 0 0 5px rgba(162, 107, 78, 0.1);
                    background-color: #ffffff;
                }

                .input-group-luxury .form-control {
                    border: none;
                    background: transparent;
                    padding: 14px 18px;
                    font-weight: 600;
                    color: #1e293b;
                }

                .input-group-luxury .form-control:focus {
                    box-shadow: none;
                    background: transparent;
                }

                .input-group-text-luxury {
                    background: #f1f5f9;
                    border: none;
                    color: var(--maison-brown);
                    font-weight: 800;
                    padding: 0 18px;
                }

                .single-input-luxury {
                    border-radius: 16px !important;
                    border: 1.5px solid var(--maison-border) !important;
                    padding: 14px 18px;
                    font-weight: 600;
                    background-color: #f8fafc;
                    transition: all 0.3s ease;
                }

                .single-input-luxury:focus {
                    border-color: var(--maison-brown) !important;
                    box-shadow: 0 0 0 5px rgba(162, 107, 78, 0.1) !important;
                    background-color: #ffffff;
                }

                /* Dropzone Foto Mewah */
                .upload-zone-luxury {
                    background: linear-gradient(135deg, #faf8f5 0%, #f4eee6 100%);
                    border: 2px dashed rgba(162, 107, 78, 0.35);
                    border-radius: 20px;
                    padding: 32px 20px;
                    text-align: center;
                    transition: all 0.3s ease;
                    cursor: pointer;
                }

                .upload-zone-luxury:hover {
                    border-color: var(--maison-brown);
                    background: linear-gradient(135deg, #f7f1eb, #ede5da);
                }

                .btn-upload-luxury {
                    background-color: var(--maison-brown);
                    color: #ffffff;
                    border: none;
                    padding: 12px 26px;
                    border-radius: 12px;
                    font-weight: 700;
                    font-size: 0.9rem;
                    box-shadow: 0 6px 15px rgba(162, 107, 78, 0.2);
                    transition: all 0.3s ease;
                    display: inline-block;
                }

                .btn-upload-luxury:hover {
                    background-color: var(--maison-brown-hover);
                    color: #ffffff;
                    transform: translateY(-1px);
                    box-shadow: 0 8px 20px rgba(162, 107, 78, 0.3);
                }

                .preview-container-luxury {
                    background: #ffffff;
                    border: 1px solid var(--maison-border);
                    border-radius: 16px;
                    padding: 12px;
                    display: inline-block;
                    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
                }

                /* Tombol Aksi Utama */
                .btn-save-luxury {
                    background-color: var(--maison-brown);
                    color: #ffffff;
                    font-weight: 700;
                    border-radius: 14px;
                    padding: 14px 32px;
                    border: none;
                    box-shadow: 0 8px 20px rgba(162, 107, 78, 0.25);
                    transition: all 0.3s ease;
                }

                .btn-save-luxury:hover {
                    background-color: var(--maison-brown-hover);
                    color: #ffffff;
                    transform: translateY(-2px);
                    box-shadow: 0 12px 25px rgba(162, 107, 78, 0.35);
                }

                .btn-back-luxury {
                    background-color: #f1f5f9;
                    color: #475569;
                    font-weight: 700;
                    border-radius: 14px;
                    padding: 14px 28px;
                    border: 1px solid var(--maison-border);
                    transition: all 0.3s ease;
                    text-decoration: none;
                }

                .btn-back-luxury:hover {
                    background-color: #e2e8f0;
                    color: #1e293b;
                }
            </style>

            {{-- Section Upload Gambar / Kamera --}}
            <div class="row mb-5">
                <div class="col-12">

                    <label class="form-label-luxury d-block">
                        Foto Katalog Produk
                    </label>

                    <div class="upload-zone-luxury">

                        <div class="mb-3">
                            <div class="mx-auto d-flex align-items-center justify-content-center mb-3 shadow-sm"
                                 style="width: 64px; height: 64px; border-radius: 50%; background: #ffffff; color: var(--maison-brown); border: 1px solid rgba(162, 107, 78, 0.2);">

                                <i class="bi bi-camera-fill fs-3"></i>

                            </div>

                            <span id="file-label-text"
                                  class="fw-bold text-dark d-block mb-1"
                                  style="font-size: 1rem;">

                                {{ isset($product) && $product->foto
                                    ? 'Ganti Foto Produk (Opsional)'
                                    : 'Unggah Foto atau Ambil Langsung' }}

                            </span>

                            <span class="text-muted small">
                                Format yang didukung: JPG, PNG, atau WEBP (Maks. 2MB)
                            </span>

                        </div>

                        {{-- Tombol Pilih Foto --}}
                        <label for="foto_input"
                               class="btn-upload-luxury m-0 cursor-pointer">

                            <i class="bi bi-cloud-arrow-up-fill me-2"></i>

                            <span>Pilih Berkas</span>

                        </label>

                        {{-- Input Foto --}}
                       <input
                            type="file"
                            id="foto_input"
                            name="foto"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            onchange="previewImage(this)"
                            class="d-none"
                        >
                    </div>

                    {{-- Error Foto --}}
                    @error('foto')
                        <div class="invalid-feedback d-block mt-2 text-center">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- Pratinjau Foto --}}
                    <div id="preview-wrapper"
                         class="mt-4 text-center"
                         style="{{ isset($product) && $product->foto ? 'display:block;' : 'display:none;' }}">

                        <span class="form-label-luxury text-muted d-block mb-2"
                              style="font-size: 0.75rem;">

                            Pratinjau Gambar Aktif

                        </span>

                        <div class="preview-container-luxury">

                            <img
                                id="preview"
                                src="{{ isset($product) && $product->foto
                                    ? asset('storage/' . $product->foto)
                                    : '' }}"
                                width="150"
                                height="150"
                                class="rounded-3 object-fit-cover shadow-sm"
                            >

                        </div>

                    </div>

                </div>
            </div>


            {{-- Input Nama Produk --}}
            <div class="mb-4">

                <label class="form-label-luxury">
                    Nama Produk
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control single-input-luxury @error('nama') is-invalid @enderror"
                    placeholder="Contoh: Royal Espresso Signature Blend"
                    value="{{ old('nama', $product->nama ?? '') }}"
                    required
                >

                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Input Harga Beli & Jual --}}
            <div class="row">

                <div class="col-md-6 mb-4">

                    <label class="form-label-luxury">
                        Harga Beli (Modal)
                    </label>

                    <div class="input-group input-group-luxury">

                        <span class="input-group-text input-group-text-luxury">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="harga_beli"
                            class="form-control @error('harga_beli') is-invalid @enderror"
                            placeholder="0"
                            value="{{ old('harga_beli', $product->harga_beli ?? '') }}"
                            min="0"
                            required
                        >

                    </div>

                    @error('harga_beli')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-md-6 mb-4">

                    <label class="form-label-luxury">
                        Harga Jual
                    </label>

                    <div class="input-group input-group-luxury">

                        <span class="input-group-text input-group-text-luxury">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="harga_jual"
                            class="form-control @error('harga_jual') is-invalid @enderror"
                            placeholder="0"
                            value="{{ old('harga_jual', $product->harga_jual ?? '') }}"
                            min="0"
                            required
                        >

                    </div>

                    @error('harga_jual')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>


            {{-- Input Stok --}}
            <div class="mb-5">

                <label class="form-label-luxury">
                    Jumlah Stok Tersedia
                </label>

                <input
                    type="number"
                    name="stok"
                    class="form-control single-input-luxury @error('stok') is-invalid @enderror"
                    placeholder="0"
                    value="{{ old('stok', $product->stok ?? '') }}"
                    min="0"
                    required
                >

                @error('stok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Action Buttons --}}
            <div class="d-flex align-items-center gap-3 pt-4 border-top"
                 style="border-color: #edf2f7 !important;">

                <button
                    class="btn btn-save-luxury d-inline-flex align-items-center gap-2"
                    type="submit">

                    <i class="bi bi-check-circle-fill fs-5"></i>

                    <span>
                        {{ isset($product)
                            ? 'Simpan Perubahan'
                            : 'Simpan Produk Baru' }}
                    </span>

                </button>

                <a
                    href="{{ route('produk.index') }}"
                    class="btn btn-back-luxury d-inline-flex align-items-center gap-2">

                    <i class="bi bi-arrow-left fs-5"></i>

                    <span>Kembali</span>

                </a>

            </div>

        </form>
        {{-- END FORM UTAMA --}}

    </div>
</div>


{{-- Script Preview Foto --}}
<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const wrapper = document.getElementById('preview-wrapper');
    const labelText = document.getElementById('file-label-text');

    if (input.files && input.files.length > 0) {
        const file = input.files[0];
        labelText.textContent = 'Berkas Dipilih: ' + file.name;

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            wrapper.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endsection