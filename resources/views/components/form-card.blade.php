@props(['action', 'back', 'title', 'edit' => false])
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card-box">
            <h5 class="fw-bold mb-1">{{ $edit ? 'Ubah' : 'Tambah' }} {{ $title }}</h5>
            <p class="text-muted small mb-4">Lengkapi formulir berikut dengan benar.</p>
            <form method="POST" action="{{ $action }}">
                @csrf
                @if($edit) @method('PUT') @endif

                {{ $slot }}

                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-gradient"><i class="bi bi-check2-circle"></i> Simpan</button>
                    <a href="{{ $back }}" class="btn btn-light border">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>