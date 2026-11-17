@extends('layouts.app')
@section('title', 'Form Pelanggan')
@section('content')
<x-form-card title="Data Pelanggan" :edit="isset($item)"
    :action="isset($item) ? route('pelanggan.update', $item) : route('pelanggan.store')"
    :back="route('pelanggan.index')">

    <div class="row g-3">
        @isset($item)
        <div class="col-md-4">
            <label class="form-label">Id Pelanggan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-hash"></i></span>
                <input type="text" class="form-control" value="{{ $item->id }}" readonly>
            </div>
        </div>
        @endisset

        <div class="{{ isset($item) ? 'col-md-8' : 'col-12' }}">
            <label class="form-label">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama lengkap pelanggan"
                       value="{{ old('nama_lengkap', $item->nama_lengkap ?? '') }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">No HP</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx"
                       value="{{ old('no_hp', $item->no_hp ?? '') }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Pekerjaan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan"
                       value="{{ old('pekerjaan', $item->pekerjaan ?? '') }}" required>
            </div>
        </div>

        <div class="col-12">
            <label class="form-label">Alamat Pelanggan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap" required>{{ old('alamat', $item->alamat ?? '') }}</textarea>
            </div>
        </div>
    </div>
</x-form-card>
@endsection