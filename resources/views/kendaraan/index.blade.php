@extends('layouts.app')
@section('title', 'Data Kendaraan')
@section('content')
<x-page-head title="Data Kendaraan" icon="bi-bicycle" sub="Kelola data kendaraan pelanggan"
    :create="route('kendaraan.create')" label="Tambah Kendaraan" />

<div class="card-box">
    <table class="table table-hover align-middle datatable w-100">
        <thead>
            <tr><th>No Plat</th><th>Jenis</th><th>No STNK</th><th>Tahun</th><th>Pemilik</th><th>Warna</th><th class="no-sort">Aksi</th></tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td><span class="plat">{{ $row->no_plat }}</span></td>
                <td>
                    @if($row->jenis_kendaraan == 'Matic')
                        <span class="badge text-bg-primary"><i class="bi bi-scooter"></i> Matic</span>
                    @else
                        <span class="badge text-bg-warning"><i class="bi bi-gear-wide-connected"></i> Manual Transmisi</span>
                    @endif
                </td>
                <td>{{ $row->no_stnk }}</td>
                <td>{{ $row->tahun_pembuatan }}</td>
                <td>{{ $row->nama_pemilik }}</td>
                <td>{{ $row->warna }}</td>
                <td><x-aksi :edit="route('kendaraan.edit', $row)" :hapus="route('kendaraan.destroy', $row)" /></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection