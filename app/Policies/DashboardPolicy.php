<?php

namespace App\Policies;

use App\Models\User;

class DashboardPolicy
{
    /**
     * Tentukan apakah user bisa melihat data keuangan dashboard.
     */
    public function viewAny(User $user): bool
    {
        // Menggunakan opsional (?->) agar tidak error jika user tidak punya role
        // Menggunakan strtolower() agar 'Admin', 'ADMIN', atau 'admin' tetap diizinkan
        return strtolower($user->role?->name ?? '') === 'admin';
    }
}
