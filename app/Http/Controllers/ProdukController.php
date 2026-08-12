<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\Produk\StoreRequest;
use App\Models\Produk;
use App\Models\Jenis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');

        $query = Produk::with(['user', 'jenis']);

        if ($keyword) {
            $products = $query->where('nama', 'like', '%' . $keyword . '%')
                ->orderBy('nama')
                ->paginate(10)
                ->withQueryString();
        } else {
            $products = $query->latest()
                ->paginate(10)
                ->withQueryString();
        }

        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Produk::class);

        $jenisList = Jenis::all();

        return view('produk.create', compact('jenisList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $data = $request->validated();
        $data['user_id'] = Auth::id();

        // Mapping jenis_id dari form ke id_jenis di database
        if (isset($data['jenis_id'])) {
            $data['id_jenis'] = $data['jenis_id'];
            unset($data['jenis_id']);
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);

        $jenisList = Jenis::all();

        return view('produk.edit', [
            'product' => $produk,
            'jenisList' => $jenisList
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        $data = $request->validated();

        // Mapping jenis_id dari form ke id_jenis di database
        if (isset($data['jenis_id'])) {
            $data['id_jenis'] = $data['jenis_id'];
            unset($data['jenis_id']);
        }

        if ($request->hasFile('foto')) {
            if (
                $produk->foto &&
                Storage::disk('public')->exists($produk->foto)
            ) {
                Storage::disk('public')->delete($produk->foto);
            }

            $data['foto'] = $request->file('foto')
                ->store('products', 'public');
        }

        $produk->update($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        $produk->itemPenjualan()->delete();

        if (
            $produk->foto &&
            Storage::disk('public')->exists($produk->foto)
        ) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}