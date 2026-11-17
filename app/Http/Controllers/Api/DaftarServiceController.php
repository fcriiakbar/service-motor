<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarService;
use Illuminate\Http\Request;

class DaftarServiceController extends Controller
{
    private function rules(): array
    {
        return [
            'no_plat'        => 'required|exists:kendaraans,no_plat',
            'pelanggan_id'   => 'required|exists:pelanggans,id',
            'keluhan'        => 'required|string',
            'tanggal_servis' => 'required|date',
        ];
    }

    public function index()
    {
        return response()->json(['success' => true, 'data' => DaftarService::with(['pelanggan', 'kendaraan'])->get()]);
    }

    public function store(Request $request)
    {
        $data = DaftarService::create($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan', 'data' => $data->load('pelanggan')], 201);
    }

    public function show(DaftarService $daftar_service)
    {
        return response()->json(['success' => true, 'data' => $daftar_service->load(['pelanggan', 'kendaraan'])]);
    }

    public function update(Request $request, DaftarService $daftar_service)
    {
        $daftar_service->update($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data berhasil diubah', 'data' => $daftar_service->load('pelanggan')]);
    }

    public function destroy(DaftarService $daftar_service)
    {
        $daftar_service->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}