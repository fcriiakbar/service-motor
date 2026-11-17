<?php

namespace App\Http\Controllers;

use App\Models\DaftarService;
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
        $data = Pembayaran::with('daftarService')->latest()->get();
        return view('pembayaran.index', compact('data'));
    }

    public function create()
    {
        return view('pembayaran.form', ['daftar' => DaftarService::orderBy('id')->get()]);
    }

    public function store(Request $request)
    {
        Pembayaran::create($request->validate($this->rules()));
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function edit(Pembayaran $pembayaran)
    {
        return view('pembayaran.form', [
            'daftar' => DaftarService::orderBy('id')->get(),
            'item'   => $pembayaran,
        ]);
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $pembayaran->update($request->validate($this->rules()));
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diubah.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}