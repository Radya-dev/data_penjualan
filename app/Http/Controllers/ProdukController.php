<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        return view('home.Produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mereks = \App\Models\Merek::all();
        return view('home.Produk.tambah', compact('mereks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'merek_id' => 'required|exists:mereks,id',
            'jenis' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk_images', 'public');
            $validated['gambar'] = $path;
        }

        Produk::create($validated);

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not used
        return redirect()->route('produk.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $mereks = \App\Models\Merek::all();
        return view('home.Produk.edit', compact('produk', 'mereks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'merek_id' => 'required|exists:mereks,id',
            'jenis' => 'required|string|max:255',
            'warna' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $path = $request->file('gambar')->store('produk_images', 'public');
            $validated['gambar'] = $path;
        }

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        // Delete image if exists
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil dihapus.');
    }
}
