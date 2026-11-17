@extends('layouts.app')
@section('title', 'Form Kendaraan')
@section('content')
@php $jenis = old('jenis_kendaraan', $item->jenis_kendaraan ?? ''); @endphp

<x-form-card title="Data Kendaraan" :edit="isset($item)"
    :action="isset($item) ? route('kendaraan.update', $item) : route('kendaraan.store')"
    :back="route('kendaraan.index')">

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">No Plat Kendaraan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                <input type="text" name="no_plat" class="form-control text-uppercase" placeholder="BL 1234 AB"
                       value="{{ old('no_plat', $item->no_plat ?? '') }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">No STNK</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                <input type="text" name="no_stnk" class="form-control" placeholder="Nomor STNK"
                       value="{{ old('no_stnk', $item->no_stnk ?? '') }}" required>
            </div>
        </div>

        <div class="col-12">
            <label class="form-label d-block">Jenis Kendaraan</label>
            <div class="d-flex gap-2">
                <input type="radio" class="btn-check" name="jenis_kendaraan" id="matic" value="Matic"
                       {{ $jenis == 'Matic' ? 'checked' : '' }} required>
                <label class="btn btn-outline-primary flex-fill py-3" for="matic">
                    <i class="bi bi-scooter fs-3 d-block"></i> Matic
                </label>

                <input type="radio" class="btn-check" name="jenis_kendaraan" id="manual" value="Manual Transmisi"
                       {{ $jenis == 'Manual Transmisi' ? 'checked' : '' }}>
                <label class="btn btn-outline-primary flex-fill py-3" for="manual">
                    <i class="bi bi-gear-wide-connected fs-3 d-block"></i> Manual Transmisi
                </label>
            </div>
        </div>

        <div class="col-md-4">
            <label class="form-label">Tahun Pembuatan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                <input type="number" name="tahun_pembuatan" class="form-control" min="1980" max="2100" placeholder="2024"
                       value="{{ old('tahun_pembuatan', $item->tahun_pembuatan ?? '') }}" required>
            </div>
        </div>

        <div class="col-md-4">
            <label class="form-label">Nama Pemilik</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="nama_pemilik" class="form-control" placeholder="Nama pemilik"
                       value="{{ old('nama_pemilik', $item->nama_pemilik ?? '') }}" required>
            </div>
        </div>

        <div class="col-md-4">
            <label class="form-label">Warna Kendaraan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-palette"></i></span>
                <input type="text" name="warna" class="form-control" placeholder="Hitam"
                       value="{{ old('warna', $item->warna ?? '') }}" required>
            </div>
        </div>
    </div>
</x-form-card>
@endsection