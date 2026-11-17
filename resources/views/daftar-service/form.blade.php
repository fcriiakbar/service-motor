@extends('layouts.app')
@section('title', 'Form Daftar Service')
@section('content')
@php
    $plat = old('no_plat', $item->no_plat ?? '');
    $pid  = old('pelanggan_id', $item->pelanggan_id ?? '');
@endphp

<x-form-card title="Daftar Service" :edit="isset($item)"
    :action="isset($item) ? route('daftar-service.update', $item) : route('daftar-service.store')"
    :back="route('daftar-service.index')">

    <div class="row g-3">
        @isset($item)
        <div class="col-md-4">
            <label class="form-label">Id Servis Pelanggan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-hash"></i></span>
                <input type="text" class="form-control" value="{{ $item->id }}" readonly>
            </div>
        </div>
        @endisset

        <div class="{{ isset($item) ? 'col-md-8' : 'col-md-6' }}">
            <label class="form-label">No Plat Kendaraan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                <select name="no_plat" class="form-select" required>
                    <option value="">-- Pilih No Plat --</option>
                    @foreach($kendaraans as $k)
                        <option value="{{ $k->no_plat }}" {{ $plat == $k->no_plat ? 'selected' : '' }}>{{ $k->no_plat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Id Pelanggan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <select name="pelanggan_id" id="pelanggan_id" class="form-select" required>
                    <option value="">-- Pilih Id Pelanggan --</option>
                    @foreach($pelanggans as $p)
                        <option value="{{ $p->id }}" data-nama="{{ $p->nama_lengkap }}" {{ $pid == $p->id ? 'selected' : '' }}>{{ $p->id }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Nama Pelanggan <span class="badge text-bg-success">otomatis</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" id="nama_pelanggan" class="form-control" placeholder="Terisi otomatis setelah Id dipilih" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Tanggal Servis</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                <input type="date" name="tanggal_servis" class="form-control"
                       value="{{ old('tanggal_servis', $item->tanggal_servis ?? date('Y-m-d')) }}" required>
            </div>
        </div>

        <div class="col-12">
            <label class="form-label">Keluhan Kendaraan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-chat-left-text"></i></span>
                <textarea name="keluhan" class="form-control" rows="3" placeholder="Jelaskan keluhan kendaraan" required>{{ old('keluhan', $item->keluhan ?? '') }}</textarea>
            </div>
        </div>
    </div>
</x-form-card>
@endsection

@push('scripts')
<script>
    const selPelanggan = document.getElementById('pelanggan_id');
    const inputNama = document.getElementById('nama_pelanggan');
    function isiNama() {
        const opt = selPelanggan.options[selPelanggan.selectedIndex];
        inputNama.value = opt ? (opt.dataset.nama || '') : '';
    }
    selPelanggan.addEventListener('change', isiNama);
    isiNama();
</script>
@endpush