<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') | Service Motor</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <script>
        document.documentElement.setAttribute('data-bs-theme', localStorage.getItem('theme') || 'light');
    </script>

    <style>
        :root { --grad: linear-gradient(135deg, #4f46e5, #7c3aed); }
        body { font-family: 'Inter', sans-serif; background: var(--bs-tertiary-bg); }

        /* Sidebar */
        .sidebar { position: fixed; top: 0; bottom: 0; left: 0; width: 260px; z-index: 1040;
            background: linear-gradient(180deg, #1e1b4b, #312e81); color: #fff;
            padding: 1.5rem 1rem; overflow-y: auto; transition: transform .3s; }
        .brand { display: flex; align-items: center; gap: .75rem; font-weight: 700; font-size: 1.15rem; margin-bottom: 2rem; color: #fff; text-decoration: none; }
        .brand i { background: var(--grad); width: 44px; height: 44px; border-radius: 12px; display: grid; place-items: center; font-size: 1.3rem; }
        .menu-title { font-size: .7rem; letter-spacing: .1em; color: #818cf8; margin: 0 0 .6rem .5rem; text-transform: uppercase; }
        .nav-x { display: flex; align-items: center; gap: .75rem; padding: .75rem 1rem; border-radius: 12px;
            color: #c7d2fe; text-decoration: none; margin-bottom: .35rem; transition: .2s; font-weight: 500; }
        .nav-x:hover { background: rgba(255,255,255,.1); color: #fff; transform: translateX(3px); }
        .nav-x.active { background: var(--grad); color: #fff; box-shadow: 0 6px 16px rgba(124,58,237,.45); }
        .nav-x i { font-size: 1.15rem; }

        /* Main */
        .main { margin-left: 260px; min-height: 100vh; }
        .topbar { position: sticky; top: 0; z-index: 1030; display: flex; justify-content: space-between; align-items: center;
            padding: .8rem 1.5rem; background: var(--bs-body-bg); border-bottom: 1px solid var(--bs-border-color); }
        .content { padding: 1.5rem; }
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: none; }
            .main { margin-left: 0; }
        }

        /* Komponen */
        .card-box { background: var(--bs-body-bg); border: 1px solid var(--bs-border-color); border-radius: 16px;
            padding: 1.25rem; box-shadow: 0 4px 20px rgba(0,0,0,.04); }
        .page-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.25rem; }
        .page-head h4 { margin: 0; font-weight: 700; }
        .btn-gradient { background: var(--grad); color: #fff; border: 0; border-radius: 10px; padding: .55rem 1.1rem; font-weight: 500; transition: .2s; }
        .btn-gradient:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 8px 18px rgba(124,58,237,.4); }
        .btn-soft-warning { background: rgba(245,158,11,.15); color: #d97706; border: 0; }
        .btn-soft-danger { background: rgba(239,68,68,.15); color: #dc2626; border: 0; }
        .btn-soft-warning:hover { background: #f59e0b; color: #fff; }
        .btn-soft-danger:hover { background: #ef4444; color: #fff; }
        .form-control, .form-select, .input-group-text { border-radius: 10px; }
        .input-group > .form-control, .input-group > .form-select { border-top-left-radius: 0; border-bottom-left-radius: 0; }
        .input-group-text { background: var(--bs-tertiary-bg); color: #7c3aed; }
        .form-control:focus, .form-select:focus { border-color: #7c3aed; box-shadow: 0 0 0 .2rem rgba(124,58,237,.18); }
        .avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--grad); color: #fff; display: inline-grid; place-items: center; font-weight: 600; }
        .plat { display: inline-block; padding: .15rem .6rem; border: 2px solid var(--bs-body-color); border-radius: 6px; font-weight: 700; letter-spacing: .08em; font-size: .85rem; }
        .stat { display: flex; align-items: center; gap: 1rem; text-decoration: none; color: inherit; transition: .25s; }
        .stat:hover { transform: translateY(-4px); color: inherit; box-shadow: 0 10px 25px rgba(0,0,0,.1); }
        .stat .ico { width: 54px; height: 54px; border-radius: 14px; display: grid; place-items: center; font-size: 1.5rem; color: #fff; }
        .stat h3 { margin: 0; font-weight: 700; }
        .hero { background: var(--grad); color: #fff; border-radius: 20px; padding: 1.75rem; position: relative; overflow: hidden; }
        .hero::after { content: ''; position: absolute; right: -40px; top: -40px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,.12); }
        .btn-check:checked + .btn-outline-primary { background: var(--grad); border-color: transparent; color: #fff; }
        .btn-outline-primary { color: #7c3aed; border-color: var(--bs-border-color); border-radius: 12px; }
        .btn-outline-primary:hover { background: rgba(124,58,237,.1); color: #7c3aed; }
        table.dataTable thead th { font-weight: 600; font-size: .85rem; text-transform: uppercase; letter-spacing: .03em; }
        .dt-search input, .dt-length select { border-radius: 10px !important; }
        .page-item.active .page-link { background: #7c3aed; border-color: #7c3aed; }
    </style>
</head>
<body>

@php
    $menu = [
        ['dashboard',        'bi-speedometer2',        'Dashboard',      'dashboard'],
        ['pelanggan.*',      'bi-people-fill',         'Pelanggan',      'pelanggan.index'],
        ['kendaraan.*',      'bi-bicycle',             'Kendaraan',      'kendaraan.index'],
        ['daftar-service.*', 'bi-card-checklist',      'Daftar Service', 'daftar-service.index'],
        ['data-service.*',   'bi-wrench-adjustable',   'Data Service',   'data-service.index'],
        ['pembayaran.*',     'bi-cash-coin',           'Pembayaran',     'pembayaran.index'],
    ];
@endphp

<aside class="sidebar" id="sidebar">
    <a href="{{ route('dashboard') }}" class="brand">
        <i class="bi bi-gear-wide-connected"></i>
        <span>Service Motor<br><small class="fw-normal" style="font-size:.7rem;color:#a5b4fc">Sistem Informasi Bengkel</small></span>
    </a>
    <p class="menu-title">Menu Utama</p>
    @foreach($menu as [$pattern, $icon, $label, $route])
        <a href="{{ route($route) }}" class="nav-x {{ request()->routeIs($pattern) ? 'active' : '' }}">
            <i class="bi {{ $icon }}"></i> {{ $label }}
        </a>
    @endforeach
</aside>

<div class="main">
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-light border d-lg-none" id="toggleSidebar"><i class="bi bi-list fs-5"></i></button>
            <span class="text-muted d-none d-md-inline"><i class="bi bi-calendar3"></i> {{ now()->format('d F Y') }}</span>
        </div>
        <button class="btn btn-light border rounded-circle" id="themeBtn" title="Ganti tema"><i class="bi bi-moon-stars-fill"></i></button>
    </div>

    <div class="content">
        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-4">
                <strong><i class="bi bi-exclamation-triangle-fill"></i> Periksa kembali isian Anda:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // DataTables otomatis untuk semua tabel .datatable
    $(function () {
        $('.datatable').DataTable({
            pageLength: 10,
            columnDefs: [{ targets: 'no-sort', orderable: false }],
            language: {
                search: '', searchPlaceholder: 'Cari data...',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                infoEmpty: 'Tidak ada data', emptyTable: 'Belum ada data',
                zeroRecords: 'Data tidak ditemukan',
                paginate: { previous: '‹', next: '›' }
            }
        });
    });

    // Konfirmasi hapus (SweetAlert2)
    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (!form.classList.contains('form-hapus')) return;
        e.preventDefault();
        Swal.fire({
            title: 'Hapus data ini?', text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning', showCancelButton: true, confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280', confirmButtonText: 'Ya, hapus', cancelButtonText: 'Batal'
        }).then(r => { if (r.isConfirmed) form.submit(); });
    });

    // Tema gelap / terang
    const themeBtn = document.getElementById('themeBtn');
    function syncIcon() {
        const dark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
        themeBtn.innerHTML = dark ? '<i class="bi bi-sun-fill"></i>' : '<i class="bi bi-moon-stars-fill"></i>';
    }
    themeBtn.addEventListener('click', function () {
        const t = document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-bs-theme', t);
        localStorage.setItem('theme', t);
        syncIcon();
    });
    syncIcon();

    // Sidebar mobile
    document.getElementById('toggleSidebar').addEventListener('click', () =>
        document.getElementById('sidebar').classList.toggle('show'));
</script>

@if(session('success'))
<script>
    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: @json(session('success')),
        showConfirmButton: false, timer: 2800, timerProgressBar: true });
</script>
@endif

@stack('scripts')
</body>
</html>