<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            // 🔒 Filter berdasarkan role
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // 🔍 Search nama user
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!session('keep_cart')) {
            // 🧹 Bersihkan transaksi pending lama milik user ini (jika ada)
            $oldPending = Penjualan::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->first();

            if ($oldPending) {
                DB::transaction(function () use ($oldPending) {
                    // kembalikan stok dari item yang sempat ditambahkan
                    foreach ($oldPending->itemPenjualan as $item) {
                        $item->produk->increment('stok', $item->kuantitas);
                    }

                    $oldPending->itemPenjualan()->delete();
                    $oldPending->delete();
                });
            }

            // 🆕 Buat transaksi baru yang benar-benar kosong
            $sale = Penjualan::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'cash'
            ]);

        } else {
            // 🔁 Masih dalam proses belanja yang sama
            $sale = Penjualan::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'status' => 'pending'
                ],
                [
                    'total_pembayaran' => 0,
                    'metode_pembayaran' => 'cash'
                ]
            );
        }

        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        // Load relasi user dan itemPenjualan beserta data produknya
        $penjualan->load(['user', 'itemPenjualan.produk']);

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if(strtolower($sale->status) === 'completed', 403);

        $sale->load('itemPenjualan');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        // Perbaikan validasi agar mendukung huruf kecil/besar (lowercase/uppercase)
        $request->validate([
            'payment_method' => 'required|string|in:cash,qris,CASH,QRIS'
        ]);

        if (strtolower($penjualan->status) !== 'pending') {
            return back()->with('errors', 'Transaksi sudah diproses');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('errors', 'Keranjang masih kosong');
        }

        DB::transaction(function () use ($penjualan, $request) {
            // 🔄 Hitung ulang total (anti manipulasi)
            $total = $penjualan->itemPenjualan()->sum('subtotal');

            $penjualan->update([
                'metode_pembayaran' => strtolower($request->payment_method),
                'total_pembayaran'  => $total,
                'status'            => 'completed'
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);

        if (strtolower($penjualan->status) !== 'pending' && strtolower($penjualan->status) !== 'open') {
            return redirect()->route('penjualan.index')->with('errors', 'Transaksi sudah selesai tidak bisa dibatalkan');
        }

        DB::transaction(function () use ($penjualan) {
            foreach ($penjualan->itemPenjualan as $item) {
                // 🔄 kembalikan stok
                $item->produk->increment('stok', $item->kuantitas);
            }

            // ❌ hapus item
            $penjualan->itemPenjualan()->delete();

            // ❌ hapus penjualan
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}