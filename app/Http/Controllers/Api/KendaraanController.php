<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return response()->json(['success' => true, 'data' => Kendaraan::all()]);
    }

    public function store(Request $request)
    {
        $data = Kendaraan::create($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan', 'data' => $data], 201);
    }

    public function show(Kendaraan $kendaraan)
    {
        return response()->json(['success' => true, 'data' => $kendaraan]);
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $kendaraan->update($request->validate($this->rules($kendaraan)));
        return response()->json(['success' => true, 'message' => 'Data berhasil diubah', 'data' => $kendaraan]);
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}