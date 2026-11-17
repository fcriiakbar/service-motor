<?php

namespace App\Http\Controllers;

use App\Models\DaftarService;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
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

    private function options(): array
    {
        return [
            'kendaraans' => Kendaraan::orderBy('no_plat')->get(),
            'pelanggans' => Pelanggan::orderBy('id')->get(),
        ];
    }

    public function index()
    {
        $data = DaftarService::with('pelanggan')->latest()->get();
        return view('daftar-service.index', compact('data'));
    }

    public function create()
    {
        return view('daftar-service.form', $this->options());
    }

    public function store(Request $request)
    {
        DaftarService::create($request->validate($this->rules()));
        return redirect()->route('daftar-service.index')->with('success', 'Daftar service berhasil ditambahkan.');
    }

    public function edit(DaftarService $daftar_service)
    {
        return view('daftar-service.form', $this->options() + ['item' => $daftar_service]);
    }

    public function update(Request $request, DaftarService $daftar_service)
    {
        $daftar_service->update($request->validate($this->rules()));
        return redirect()->route('daftar-service.index')->with('success', 'Daftar service berhasil diubah.');
    }

    public function destroy(DaftarService $daftar_service)
    {
        $daftar_service->delete();
        return redirect()->route('daftar-service.index')->with('success', 'Daftar service berhasil dihapus.');
    }
}