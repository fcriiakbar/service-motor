<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    private function rules(): array
    {
        return [
            'daftar_service_id' => 'required|exists:daftar_services,id',
            'jumlah_biaya'      => 'required|integer|min:0',
            'jenis_pembayaran'  => 'required|in:Cash / Tunai,Non Tunai',
            'keterangan'        => 'nullable|string',
        ];
    }

    public function index()
    {
        return response()->json(['success' => true, 'data' => Pembayaran::with('daftarService')->get()]);
    }

    public function store(Request $request)
    {
        $data = Pembayaran::create($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan', 'data' => $data], 201);
    }

    public function show(Pembayaran $pembayaran)
    {
        return response()->json(['success' => true, 'data' => $pembayaran->load('daftarService')]);
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $pembayaran->update($request->validate($this->rules()));
        return response()->json(['success' => true, 'message' => 'Data berhasil diubah', 'data' => $pembayaran]);
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}