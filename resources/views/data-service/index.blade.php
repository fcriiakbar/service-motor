@extends('layouts.app')
@section('title', 'Data Service')
@section('content')
<x-page-head title="Data Service" icon="bi-wrench-adjustable" sub="Penanganan servis oleh mekanik"
    :create="route('data-service.create')" label="Tambah Data Service" />

<div class="card-box">
    <table class="table table-hover align-middle datatable w-100">
        <thead>
            <tr><th>No</th><th>Id Servis</th><th>Keluhan</th><th>Estimasi</th><th>Mekanik</th><th>Sparepart Pengganti</th><th class="no-sort">Aksi</th></tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><span class="badge text-bg-primary">#{{ $row->daftar_service_id }}</span></td>
                <td>{{ \Illuminate\Support\Str::limit($row->daftarService->keluhan ?? '-', 50) }}</td>
                <td><i class="bi bi-hourglass-split text-warning"></i> {{ $row->estimasi_service }}</td>
                <td><span class="avatar me-2" style="width:30px;height:30px;font-size:.8rem">{{ strtoupper(substr($row->nama_mekanik, 0, 1)) }}</span>{{ $row->nama_mekanik }}</td>
                <td>{{ $row->sparepart_pengganti ?: '-' }}</td>
                <td><x-aksi :edit="route('data-service.edit', $row)" :hapus="route('data-service.destroy', $row)" /></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection