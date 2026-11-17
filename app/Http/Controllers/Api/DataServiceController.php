<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataService;
use Illuminate\Http\Request;

class DataServiceController extends Controller
{
    private function rules(): array
    {
        return [
            'daftar_service_id'   => 'required|exists:daftar_services,id',
            'estimasi_service'    => 'required|string|max:255',
            'nama_mekanik'        => 'required|string|max:255',
            'sparepart_pengganti' => 'nullable|string',
        ];
    }

    public function index()
    {
        return response()->json(['success' => true, 'data' => DataService::with('daftarService')->get()]);
    }

    public function store(Request $request)
    {
        $data = DataService::create($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan', 'data' => $data->load('daftarService')], 201);
    }

    public function show(DataService $data_service)
    {
        return response()->json(['success' => true, 'data' => $data_service->load('daftarService')]);
    }

    public function update(Request $request, DataService $data_service)
    {
        $data_service->update($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data berhasil diubah', 'data' => $data_service->load('daftarService')]);
    }

    public function destroy(DataService $data_service)
    {
        $data_service->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}