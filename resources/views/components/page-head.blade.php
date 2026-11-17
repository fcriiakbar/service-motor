@props(['title', 'icon', 'sub' => '', 'create', 'label' => 'Tambah Data'])
<div class="page-head">
    <div>
        <h4><i class="bi {{ $icon }} text-primary"></i> {{ $title }}</h4>
        <small class="text-muted">{{ $sub }}</small>
    </div>
    <a href="{{ $create }}" class="btn btn-gradient"><i class="bi bi-plus-lg"></i> {{ $label }}</a>
</div>