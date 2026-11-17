@extends('layouts.app')
@section('title', 'Data Pelanggan')
@section('content')
<x-page-head title="Data Pelanggan" icon="bi-people-fill" sub="Kelola data pelanggan bengkel"
    :create="route('pelanggan.create')" label="Tambah Pelanggan" />

<div class="card-box">
    <table class="table table-hover align-middle datatable w-100">
        <thead>
            <tr><th>Id</th><th>Nama Lengkap</th><th>No HP</th><th>Alamat</th><th>Pekerjaan</th><th class="no-sort">Aksi</th></tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td><span class="badge text-bg-primary">#{{ $row->id }}</span></td>
                <td>
                    <span class="avatar me-2">{{ strtoupper(substr($row->nama_lengkap, 0, 1)) }}</span>
                    <span class="fw-semibold">{{ $row->nama_lengkap }}</span>
                </td>
                <td><i class="bi bi-telephone text-muted"></i> {{ $row->no_hp }}</td>
                <td>{{ $row->alamat }}</td>
                <td><span class="badge rounded-pill text-bg-light border">{{ $row->pekerjaan }}</span></td>
                <td><x-aksi :edit="route('pelanggan.edit', $row)" :hapus="route('pelanggan.destroy', $row)" /></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection