<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanController extends Controller
{
    private function rules(?Kendaraan $kendaraan = null): array
    {
        return [
            'no_plat'         => ['required', 'string', 'max:15', Rule::unique('kendaraans', 'no_plat')->ignore($kendaraan)],
            'jenis_kendaraan' => 'required|in:Matic,Manual Transmisi',
            'no_stnk'         => 'required|string|max:50',
            'tahun_pembuatan' => 'required|digits:4',
            'nama_pemilik'    => 'required|string|max:255',
            'warna'           => 'required|string|max:50',
        ];
    }

    public function index()
    {
        $data = Kendaraan::latest()->get();
        return view('kendaraan.index', compact('data'));
    }

    public function create()
    {
        return view('kendaraan.form');
    }

    public function store(Request $request)
    {
        Kendaraan::create($request->validate($this->rules()));
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.form', ['item' => $kendaraan]);
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $kendaraan->update($request->validate($this->rules($kendaraan)));
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil diubah.');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil dihapus.');
    }
}