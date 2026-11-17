@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="hero mb-4">
    <h3 class="fw-bold mb-1">Selamat datang di Service Motor 👋</h3>
    <p class="mb-3 opacity-75">Pantau pelanggan, kendaraan, servis, dan pendapatan bengkel dalam satu tempat.</p>
    <div class="fs-6 opacity-75">Total Pendapatan</div>
    <div class="display-6 fw-bold">Rp {{ number_format($stat['pendapatan'], 0, ',', '.') }}</div>
</div>

@php
    $cards = [
        ['Pelanggan',      $stat['pelanggan'],  'bi-people-fill',       'linear-gradient(135deg,#6366f1,#8b5cf6)', 'pelanggan.index'],
        ['Kendaraan',      $stat['kendaraan'],  'bi-bicycle',           'linear-gradient(135deg,#06b6d4,#3b82f6)', 'kendaraan.index'],
        ['Daftar Service', $stat['daftar'],     'bi-card-checklist',    'linear-gradient(135deg,#f59e0b,#ef4444)', 'daftar-service.index'],
        ['Data Service',   $stat['data'],       'bi-wrench-adjustable', 'linear-gradient(135deg,#10b981,#059669)', 'data-service.index'],
        ['Pembayaran',     $stat['pembayaran'], 'bi-cash-coin',         'linear-gradient(135deg,#ec4899,#be185d)', 'pembayaran.index'],
    ];
@endphp

<div class="row g-3 mb-4">
    @foreach($cards as [$label, $total, $icon, $bg, $route])
        <div class="col-6 col-md-4 col-xl">
            <a href="{{ route($route) }}" class="card-box stat">
                <div class="ico" style="background: {{ $bg }}"><i class="bi {{ $icon }}"></i></div>
                <div>
                    <h3>{{ $total }}</h3>
                    <small class="text-muted">{{ $label }}</small>
                </div>
            </a>
        </div>
    @endforeach
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card-box h-100">
            <h6 class="fw-bold mb-3"><i class="bi bi-bar-chart-fill text-primary"></i> Jumlah Servis 6 Bulan Terakhir</h6>
            <canvas id="chartBulan" height="110"></canvas>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-box h-100">
            <h6 class="fw-bold mb-3"><i class="bi bi-pie-chart-fill text-primary"></i> Jenis Kendaraan</h6>
            <canvas id="chartJenis"></canvas>
        </div>
    </div>
</div>

<div class="card-box">
    <h6 class="fw-bold mb-3"><i class="bi bi-clock-history text-primary"></i> Servis Terbaru</h6>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead><tr><th>Id</th><th>No Plat</th><th>Pelanggan</th><th>Keluhan</th><th>Tanggal</th></tr></thead>
            <tbody>
            @forelse($terbaru as $row)
                <tr>
                    <td><span class="badge text-bg-primary">#{{ $row->id }}</span></td>
                    <td><span class="plat">{{ $row->no_plat }}</span></td>
                    <td>{{ $row->pelanggan->nama_lengkap ?? '-' }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($row->keluhan, 50) }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal_servis)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data servis</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    Chart.defaults.color = getComputedStyle(document.body).color;
    Chart.defaults.font.family = 'Inter, sans-serif';

    new Chart(document.getElementById('chartBulan'), {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{ label: 'Jumlah Servis', data: @json($perBulan),
                backgroundColor: 'rgba(124,58,237,.75)', borderRadius: 8 }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
    });

    new Chart(document.getElementById('chartJenis'), {
        type: 'doughnut',
        data: {
            labels: @json($jenis->keys()),
            datasets: [{ data: @json($jenis->values()), backgroundColor: ['#6366f1', '#f59e0b'], borderWidth: 0 }]
        },
        options: { cutout: '65%', plugins: { legend: { position: 'bottom' } } }
    });
</script>
@endpush