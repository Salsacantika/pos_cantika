<div class="card border-0 shadow-sm rounded-4 overflow-hidden my-4">
    
    {{-- Card Header dengan Aksen Warna Maison --}}
    <div class="card-header border-0 py-3 px-4 bg-maison-light">
        <h5 class="fw-bold mb-0 text-maison-dark d-flex align-items-center gap-2">
            <i class="bi bi-person-gear fs-4 text-maison-primary"></i>
            <span>{{ isset($user) ? 'Edit Data User' : 'Tambah User Baru' }}</span>
        </h5>
    </div>

    <div class="card-body p-4">
        
        {{-- Form Nama --}}
        <div class="mb-3">
            <label class="form-label fw-medium text-secondary">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted px-3">
                    <i class="bi bi-person"></i>
                </span>
                <input type="text" name="name"
                       class="form-control border-start-0 bg-light-subtle @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name ?? '') }}"
                       placeholder="Masukkan nama pengguna">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Form Email --}}
        <div class="mb-3">
            <label class="form-label fw-medium text-secondary">Alamat Email</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted px-3">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" name="email"
                       class="form-control border-start-0 bg-light-subtle @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email ?? '') }}"
                       placeholder="contoh@maison.com">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Form Password --}}
        <div class="mb-3">
            <label class="form-label fw-medium text-secondary">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted px-3">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" name="password"
                       class="form-control border-start-0 bg-light-subtle @error('password') is-invalid @enderror"
                       placeholder="{{ isset($user) ? 'Kosongkan jika tidak ingin mengubah password' : 'Masukkan password baru' }}">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            @if(isset($user))
                <div class="form-text text-muted small ms-1 mt-1">
                    <i class="bi bi-info-circle me-1"></i>Biarkan kosong jika tidak ingin mengganti password.
                </div>
            @endif
        </div>

        {{-- Form Role --}}
        <div class="mb-4">
            <label class="form-label fw-medium text-secondary">Hak Akses (Role)</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted px-3">
                    <i class="bi bi-shield-check"></i>
                </span>
                <select name="role_id"
                        class="form-select border-start-0 bg-light-subtle @error('role_id') is-invalid @enderror">
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" 
                        @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                        {{ ucfirst($role->name) }}
                    </option>
                    @endforeach
                </select>
                @error('role_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
            <a href="{{ route('admin.users') }}" class="btn btn-maison-outline px-4 py-2 rounded-3 fw-medium">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <button type="submit" class="btn btn-maison-primary px-4 py-2 rounded-3 fw-medium">
                <i class="bi bi-check-lg me-1"></i> Simpan
            </button>
        </div>

    </div>
</div>

{{-- Styling Khusus Form (Cocok dengan Tema Sidebar/Navbar Maison) --}}
<style>
    /* Variabel Warna Maison */
    .bg-maison-light {
        background-color: #faf5f0;
    }
    .text-maison-dark {
        color: #332b27;
    }
    .text-maison-primary {
        color: #b37456;
    }

    /* Input Focus Styling */
    .form-control:focus, .form-select:focus {
        border-color: #b37456;
        box-shadow: 0 0 0 0.25rem rgba(179, 116, 86, 0.15);
    }

    /* Icon Input Fix */
    .input-group-text {
        border-color: #dee2e6;
    }
    .input-group .form-control:focus + .input-group-text,
    .input-group:focus-within .input-group-text {
        border-color: #b37456;
    }

    /* Tombol Utama (Primary) */
    .btn-maison-primary {
        background-color: #b37456;
        color: #ffffff;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-maison-primary:hover {
        background-color: #985e43;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(179, 116, 86, 0.2);
    }

    /* Tombol Secondary/Kembali (Outline) */
    .btn-maison-outline {
        border: 1px solid #d4c5bb;
        color: #6e645e;
        background-color: #ffffff;
        transition: all 0.2s ease;
    }
    .btn-maison-outline:hover {
        background-color: #faf5f0;
        color: #b37456;
        border-color: #b37456;
    }
</style>