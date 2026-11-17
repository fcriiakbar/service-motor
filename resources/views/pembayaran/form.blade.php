@extends('layouts.app')
@section('title', 'Form Pembayaran')
@section('content')
@php
    $sid   = old('daftar_service_id', $item->daftar_service_id ?? '');
    $jenis = old('jenis_pembayaran', $item->jenis_pembayaran ?? '');
@endphp

<x-form-card title="Pembayaran Service" :edit="isset($item)"
    :action="isset($item) ? route('pembayaran.update', $item) : route('pembayaran.store')"
    :back="route('pembayaran.index')">

    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Id Servis Pelanggan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-hash"></i></span>
                <select name="daftar_service_id" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    @foreach($daftar as $d)
                        <option value="{{ $d->id }}" {{ $sid == $d->id ? 'selected' : '' }}>{{ $d->id }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-8">
            <label class="form-label">Jumlah Biaya Servis</label>
            <div class="input-group">
                <span class="input-group-text fw-bold">Rp</span>
                <input type="number" name="jumlah_biaya" id="jumlah_biaya" min="0" class="form-control" placeholder="0"
                       value="{{ old('jumlah_biaya', $item->jumlah_biaya ?? '') }}" required>
            </div>
            <div class="form-text fw-semibold text-success" id="preview"></div>
        </div>

        <div class="col-12">
            <label class="form-label d-block">Jenis Pembayaran</label>
            <div class="d-flex gap-2">
                <input type="radio" class="btn-check" name="jenis_pembayaran" id="cash" value="Cash / Tunai"
                       {{ $jenis == 'Cash / Tunai' ? 'checked' : '' }} required>
                <label class="btn btn-outline-primary flex-fill py-3" for="cash">
                    <i class="bi bi-cash-coin fs-3 d-block"></i> Cash / Tunai
                </label>

                <input type="radio" class="btn-check" name="jenis_pembayaran" id="nontunai" value="Non Tunai"
                       {{ $jenis == 'Non Tunai' ? 'checked' : '' }}>
                <label class="btn btn-outline-primary flex-fill py-3" for="nontunai">
                    <i class="bi bi-credit-card fs-3 d-block"></i> Non Tunai
                </label>
            </div>
        </div>

        <div class="col-12">
            <label class="form-label">Keterangan</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-journal-text"></i></span>
                <textarea name="keterangan" class="form-control" rows="2" placeholder="Contoh: Lunas">{{ old('keterangan', $item->keterangan ?? '') }}</textarea>
            </div>
        </div>
    </div>
</x-form-card>
@endsection

@push('scripts')
<script>
    const inputBiaya = document.getElementById('jumlah_biaya');
    const preview = document.getElementById('preview');
    function formatRupiah() {
        const v = parseInt(inputBiaya.value);
        preview.textContent = isNaN(v) ? '' : 'Terbaca: Rp ' + v.toLocaleString('id-ID');
    }
    inputBiaya.addEventListener('input', formatRupiah);
    formatRupiah();
</script>
@endpush