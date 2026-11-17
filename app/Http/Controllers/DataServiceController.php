<?php

namespace App\Http\Controllers;

use App\Models\DaftarService;
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
        $data = DataService::with('daftarService')->latest()->get();
        return view('data-service.index', compact('data'));
    }

    public function create()
    {
        return view('data-service.form', ['daftar' => DaftarService::orderBy('id')->get()]);
    }

    public function store(Request $request)
    {
        DataService::create($request->validate($this->rules()));
        return redirect()->route('data-service.index')->with('success', 'Data service berhasil ditambahkan.');
    }

    public function edit(DataService $data_service)
    {
        return view('data-service.form', [
            'daftar' => DaftarService::orderBy('id')->get(),
            'item'   => $data_service,
        ]);
    }

    public function update(Request $request, DataService $data_service)
    {
        $data_service->update($request->validate($this->rules()));
        return redirect()->route('data-service.index')->with('success', 'Data service berhasil diubah.');
    }

    public function destroy(DataService $data_service)
    {
        $data_service->delete();
        return redirect()->route('data-service.index')->with('success', 'Data service berhasil dihapus.');
    }
}