<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merek;
use Illuminate\Support\Facades\Storage;

class MerekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mereks = Merek::all();
        return view('home.Merek.index', compact('mereks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.Merek.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_merek' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('merek_logos', 'public');
            $validated['logo'] = $path;
        }

        Merek::create($validated);

        return redirect()->route('merek.index')->with('success', 'Data merek berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not used
        return redirect()->route('merek.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $merek = Merek::findOrFail($id);
        return view('home.Merek.edit', compact('merek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $merek = Merek::findOrFail($id);

        $validated = $request->validate([
            'nama_merek' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($merek->logo && Storage::disk('public')->exists($merek->logo)) {
                Storage::disk('public')->delete($merek->logo);
            }
            $path = $request->file('logo')->store('merek_logos', 'public');
            $validated['logo'] = $path;
        }

        $merek->update($validated);

        return redirect()->route('merek.index')->with('success', 'Data merek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $merek = Merek::findOrFail($id);

        // Delete logo if exists
        if ($merek->logo && Storage::disk('public')->exists($merek->logo)) {
            Storage::disk('public')->delete($merek->logo);
        }

        $merek->delete();

        return redirect()->route('merek.index')->with('success', 'Data merek berhasil dihapus.');
    }
}
