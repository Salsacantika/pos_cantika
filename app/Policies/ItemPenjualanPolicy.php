<?php

namespace App\Policies;

use App\Models\ItemPenjualan;
use App\Models\User;

class ItemPenjualanPolicy
{
   public function delete(User $user, ItemPenjualan $item): bool
   {
      // Boleh hapus selama transaksi belum selesai
      return $item->penjualan->status !== 'completed';
   }
}
