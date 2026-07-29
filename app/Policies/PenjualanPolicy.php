<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Penjualan;

class PenjualanPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Penjualan $penjualan): bool
    {
        if (strtolower($user->role->name) === 'admin') {
            return true;
        }

        return $user->id === $penjualan->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array(strtolower($user->role->name), ['admin', 'kasir']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Penjualan $penjualan): bool
    {
        // ❗ Hanya Admin yang boleh update, dan hanya jika transaksi masih OPEN
        if (strtolower($user->role->name) !== 'admin') {
            return false;
        }

        $isOpen = strtolower($penjualan->status) === 'pending'
            || strtolower($penjualan->status) === 'open';

        return $isOpen;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Penjualan $penjualan): bool
    {
        // ❗ Hanya Admin yang boleh delete, dan hanya jika transaksi masih OPEN
        if (strtolower($user->role->name) !== 'admin') {
            return false;
        }

        $isOpen = strtolower($penjualan->status) === 'pending'
            || strtolower($penjualan->status) === 'open';

        return $isOpen;
    }
}