@extends('layouts.app')
@section('title', 'Daftar Service')
@section('content')
<x-page-head title="Daftar Service" icon="bi-card-checklist" sub="Pendaftaran servis kendaraan pelanggan"
    :create="route('daftar-service.create')" label="Daftar Service Baru" />

<div class="card-box">
    <table class="table table-hover align-middle datatable w-100">
        <thead>
            <tr><th>Id Servis</th><th>No Plat</th><th>Pelanggan</th><th>Keluhan</th><th>Tanggal</th><th class="no-sort">Aksi</th></tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td><span class="badge text-bg-primary">#{{ $row->id }}</span></td>
                <td><span class="plat">{{ $row->no_plat }}</span></td>
                <td>
                    <div class="fw-semibold">{{ $row->pelanggan->nama_lengkap ?? '-' }}</div>
                    <small class="text-muted">Id Pelanggan: {{ $row->pelanggan_id }}</small>
                </td>
                <td>{{ \Illuminate\Support\Str::limit($row->keluhan, 60) }}</td>
                <td data-order="{{ $row->tanggal_servis }}">
                    <i class="bi bi-calendar-check text-muted"></i>
                    {{ \Carbon\Carbon::parse($row->tanggal_servis)->format('d M Y') }}
                </td>
                <td><x-aksi :edit="route('daftar-service.edit', $row)" :hapus="route('daftar-service.destroy', $row)" /></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection