<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {

            // Cari transaksi pending milik user yang sedang login.
            // Jika belum ada, otomatis buat transaksi baru.
            $sale = Penjualan::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'status' => 'pending',
                ],
                [
                    'total_pembayaran' => 0,
                    'metode_pembayaran' => 'cash',
                ]
            );

            // Cari produk dan kunci data selama transaksi berjalan
            $product = Produk::lockForUpdate()
                ->findOrFail($request->product_id);

            // Cek stok produk
            if ($product->stok < $request->quantity) {
                throw new \Exception('Produk stok tidak mencukupi');
            }

            // Kurangi stok produk
            $product->decrement('stok', $request->quantity);

            // Cari apakah produk sudah ada di keranjang
            $item = ItemPenjualan::where('penjualan_id', $sale->id)
                ->where('produk_id', $product->id)
                ->lockForUpdate()
                ->first();

            if ($item) {

                // Jika produk sudah ada, tambahkan jumlahnya
                $item->kuantitas += $request->quantity;

            } else {

                // Jika belum ada, buat item baru
                $item = new ItemPenjualan([
                    'penjualan_id' => $sale->id,
                    'produk_id' => $product->id,
                    'kuantitas' => $request->quantity,
                    'harga_satuan' => $product->harga_jual,
                ]);
            }

            // Hitung subtotal
            $item->subtotal = $item->kuantitas * $item->harga_satuan;

            // Simpan item
            $item->save();

            // Hitung ulang total pembayaran
            $sale->total_pembayaran = $sale->itemPenjualan()
                ->sum('subtotal');

            // Simpan total transaksi
            $sale->save();
        });

        // 🚦 keep_cart = true → beri tahu PenjualanController::create() bahwa ini
        // BUKAN navigasi baru, jadi jangan reset transaksi pending yang baru dibuat.
        return back()
            ->with('success', 'Produk berhasil ditambahkan ke keranjang')
            ->with('keep_cart', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemPenjualan $itempenjualan)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request, $itempenjualan) {

            $produk = $itempenjualan->produk()->lockForUpdate()->first();

            $selisih = $request->quantity - $itempenjualan->kuantitas;

            // 🔍 Jika qty bertambah = kurangi stok
            if ($selisih > 0) {
                if ($produk->stok < $selisih) {
                    return redirect()->route('penjualan.create')
                        ->with('errors', 'Stok tidak mencukupi')
                        ->with('keep_cart', true);
                }
                $produk->decrement('stok', $selisih);
            }

            // 🔍 Jika qty berkurang = kembalikan stok
            if ($selisih < 0) {
                $produk->increment('stok', abs($selisih));
            }

            // 💾 Update item
            $itempenjualan->update([
                'kuantitas' => $request->quantity,
                'subtotal' => $request->quantity * $itempenjualan->harga_satuan
            ]);

            // 🔄 Update total penjualan
            $itempenjualan->penjualan->update([
                'total_pembayaran' =>
                    $itempenjualan->penjualan->itemPenjualan()->sum('subtotal')
            ]);
        });

        // 🚦 keep_cart = true → jangan reset transaksi pending saat balik ke create()
        return back()->with('keep_cart', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemPenjualan $itempenjualan)
    {
        $this->authorize('delete', $itempenjualan);

        DB::transaction(function () use ($itempenjualan) {

            $produk = $itempenjualan->produk;
            $sale   = $itempenjualan->penjualan;

            // 🔄 Kembalikan stok
            $produk->increment('stok', $itempenjualan->kuantitas);

            // ❌ Hapus item
            $itempenjualan->delete();

            // 🔄 Update total penjualan
            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        // 🚦 keep_cart = true → jangan reset transaksi pending saat balik ke create()
        return back()->with('keep_cart', true);
    }
}