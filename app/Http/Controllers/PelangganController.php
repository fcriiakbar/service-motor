<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    private function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:20',
            'alamat'       => 'required|string',
            'pekerjaan'    => 'required|string|max:255',
        ];
    }

    public function index()
    {
        $data = Pelanggan::latest()->get();
        return view('pelanggan.index', compact('data'));
    }

    public function create()
    {
        return view('pelanggan.form');
    }

    public function store(Request $request)
    {
        Pelanggan::create($request->validate($this->rules()));
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.form', ['item' => $pelanggan]);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->validate($this->rules()));
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diubah.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }
}