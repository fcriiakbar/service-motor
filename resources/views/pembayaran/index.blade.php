@extends('layouts.app')
@section('title', 'Pembayaran Service')
@section('content')
<x-page-head title="Pembayaran Service" icon="bi-cash-coin" sub="Riwayat pembayaran servis pelanggan"
    :create="route('pembayaran.create')" label="Tambah Pembayaran" />

<div class="card-box">
    <table class="table table-hover align-middle datatable w-100">
        <thead>
            <tr><th>No</th><th>Id Servis</th><th>Jumlah Biaya</th><th>Jenis Pembayaran</th><th>Keterangan</th><th class="no-sort">Aksi</th></tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><span class="badge text-bg-primary">#{{ $row->daftar_service_id }}</span></td>
                <td data-order="{{ $row->jumlah_biaya }}" class="fw-bold text-success">
                    Rp {{ number_format($row->jumlah_biaya, 0, ',', '.') }}
                </td>
                <td>
                    @if($row->jenis_pembayaran == 'Cash / Tunai')
                        <span class="badge text-bg-success"><i class="bi bi-cash-coin"></i> Cash / Tunai</span>
                    @else
                        <span class="badge text-bg-info"><i class="bi bi-credit-card"></i> Non Tunai</span>
                    @endif
                </td>
                <td>{{ $row->keterangan ?: '-' }}</td>
                <td><x-aksi :edit="route('pembayaran.edit', $row)" :hapus="route('pembayaran.destroy', $row)" /></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection