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
        
        $sales = Penjualan::query()
            // 🔒 Filter berdasarkan role kasir
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // 🎯 Filter berdasarkan Status dari Modal
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            // 📅 Filter berdasarkan Tanggal dari Modal
            ->when($request->tanggal, function ($query) use ($request) {
                $query->whereDate('created_at', $request->tanggal);
            })
            // 🔍 Search teks biasa (opsional jika masih dipakai)
            ->when($request->search, function ($query) use ($request) {
                $keyword = $request->search;
                $query->where(function ($q) use ($keyword) {
                    $q->where('id', 'like', '%' . $keyword . '%')
                      ->orWhere('metode_pembayaran', 'like', '%' . $keyword . '%')
                      ->orWhereHas('user', function ($userQuery) use ($keyword) {
                          $userQuery->where('name', 'like', '%' . $keyword . '%');
                      });
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
            $oldPending = Penjualan::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->first();

            if ($oldPending) {
                DB::transaction(function () use ($oldPending) {
                    foreach ($oldPending->itemPenjualan as $item) {
                        $item->produk->increment('stok', $item->kuantitas);
                    }

                    $oldPending->itemPenjualan()->delete();
                    $oldPending->delete();
                });
            }

            $sale = Penjualan::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'cash'
            ]);

        } else {
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
                $item->produk->increment('stok', $item->kuantitas);
            }

            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}