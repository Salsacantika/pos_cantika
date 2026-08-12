<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis = Jenis::with('user')->latest()->paginate(10);

        return view('jenis.index', compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis' => ['required', 'string', 'max:255', 'unique:jenis,nama_jenis'],
        ]);

        // 🔧 user_id wajib diisi karena kolomnya NOT NULL di migration
        $validated['user_id'] = Auth::id();

        Jenis::create($validated);

        return Redirect::route('jenis.index')->with('success', 'Jenis berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jenis = Jenis::findOrFail($id);

        return view('jenis.show', compact('jenis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenis = Jenis::findOrFail($id);

        return view('jenis.edit', compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenis = Jenis::findOrFail($id);

        $validated = $request->validate([
            'nama_jenis' => ['required', 'string', 'max:255', 'unique:jenis,nama_jenis,' . $jenis->id],
        ]);

        $jenis->update($validated);

        return Redirect::route('jenis.index')->with('success', 'Jenis berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis = Jenis::findOrFail($id);
        $jenis->delete();

        return Redirect::route('jenis.index')->with('success', 'Jenis berhasil dihapus.');
    }
}