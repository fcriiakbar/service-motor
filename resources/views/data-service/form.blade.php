@extends('layouts.app')
@section('title', 'Form Data Service')
@section('content')
@php $sid = old('daftar_service_id', $item->daftar_service_id ?? ''); @endphp

<x-form-card title="Data Service" :edit="isset($item)"
    :action="isset($item) ? route('data-service.update', $item) : route('data-service.store')"
    :back="route('data-service.index')">

    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Id Servis Pelanggan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-hash"></i></span>
                <select name="daftar_service_id" id="daftar_service_id" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    @foreach($daftar as $d)
                        <option value="{{ $d->id }}" data-keluhan="{{ $d->keluhan }}" {{ $sid == $d->id ? 'selected' : '' }}>{{ $d->id }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-8">
            <label class="form-label">Keluhan Kendaraan <span class="badge text-bg-success">otomatis</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-chat-left-text"></i></span>
                <textarea id="keluhan" class="form-control" rows="2" placeholder="Terisi otomatis setelah Id servis dipilih" readonly></textarea>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Estimasi Service</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-hourglass-split"></i></span>
                <input type="text" name="estimasi_service" class="form-control" placeholder="contoh: 2 hari"
                       value="{{ old('estimasi_service', $item->estimasi_service ?? '') }}" required>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Nama Mekanik</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-gear"></i></span>
                <input type="text" name="nama_mekanik" class="form-control" placeholder="Nama mekanik"
                       value="{{ old('nama_mekanik', $item->nama_mekanik ?? '') }}" required>
            </div>
        </div>

        <div class="col-12">
            <label class="form-label">Sparepart Pengganti</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-nut"></i></span>
                <textarea name="sparepart_pengganti" class="form-control" rows="2" placeholder="Kosongkan jika tidak ada">{{ old('sparepart_pengganti', $item->sparepart_pengganti ?? '') }}</textarea>
            </div>
        </div>
    </div>
</x-form-card>
@endsection

@push('scripts')
<script>
    const selServis = document.getElementById('daftar_service_id');
    const areaKeluhan = document.getElementById('keluhan');
    function isiKeluhan() {
        const opt = selServis.options[selServis.selectedIndex];
        areaKeluhan.value = opt ? (opt.dataset.keluhan || '') : '';
    }
    selServis.addEventListener('change', isiKeluhan);
    isiKeluhan();
</script>
@endpush