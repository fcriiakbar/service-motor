<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return response()->json(['success' => true, 'data' => Pelanggan::all()]);
    }

    public function store(Request $request)
    {
        $data = Pelanggan::create($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan', 'data' => $data], 201);
    }

    public function show(Pelanggan $pelanggan)
    {
        return response()->json(['success' => true, 'data' => $pelanggan]);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data berhasil diubah', 'data' => $pelanggan]);
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}