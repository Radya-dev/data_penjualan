<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produk;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualans = Penjualan::with('produk')->get();
        return view('home.Penjualan.index', compact('penjualans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::all();
        return view('home.Penjualan.tambah', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'produk_id' => 'required|exists:produks,id',
            'jumlah_pembelian' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($validated['produk_id']);

        // Check if stock is sufficient
        if ($produk->stok < $validated['jumlah_pembelian']) {
            return redirect()->back()->withErrors(['jumlah_pembelian' => 'Stok produk tidak cukup.']);
        }

        $penjualanData = [
            'tanggal' => $validated['tanggal'],
            'produk_id' => $validated['produk_id'],
            'nama_produk' => $produk->merek,
            'jenis_produk' => $produk->jenis,
            'warna_produk' => $produk->warna,
            'jumlah_pembelian' => $validated['jumlah_pembelian'],
            'harga_satuan' => $produk->harga,
            'total_harga' => $produk->harga * $validated['jumlah_pembelian'],
        ];

        Penjualan::create($penjualanData);

        // Reduce stock
        $produk->stok -= $validated['jumlah_pembelian'];
        $produk->save();

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not used
        return redirect()->route('penjualan.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penjualan = Penjualan::with('produk.merek')->findOrFail($id);
        $produks = Produk::all();
        return view('home.Penjualan.edit', compact('penjualan', 'produks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'produk_id' => 'required|exists:produks,id',
            'jumlah_pembelian' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($validated['produk_id']);

        // Calculate the difference in jumlah_pembelian
        $jumlahDifference = $validated['jumlah_pembelian'] - $penjualan->jumlah_pembelian;

        // Check if stock is sufficient for increase in jumlah_pembelian
        if ($jumlahDifference > 0 && $produk->stok < $jumlahDifference) {
            return redirect()->back()->withErrors(['jumlah_pembelian' => 'Stok produk tidak cukup.']);
        }

        // Adjust stock based on the difference
        $produk->stok -= $jumlahDifference;
        $produk->save();

        $penjualanData = [
            'tanggal' => $validated['tanggal'],
            'produk_id' => $validated['produk_id'],
            'nama_produk' => $produk->merek,
            'jenis_produk' => $produk->jenis,
            'warna_produk' => $produk->warna,
            'jumlah_pembelian' => $validated['jumlah_pembelian'],
            'harga_satuan' => $produk->harga,
            'total_harga' => $produk->harga * $validated['jumlah_pembelian'],
        ];

        $penjualan->update($penjualanData);

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil dihapus.');
    }

    /**
     * Display the sales report for printing.
     */
    public function laporan()
    {
        $penjualans = Penjualan::with('produk.merek')->get();
        return view('home.Penjualan.laporan', compact('penjualans'));
    }
}
