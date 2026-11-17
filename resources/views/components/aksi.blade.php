@props(['edit', 'hapus'])
<div class="d-flex gap-1">
    <a href="{{ $edit }}" class="btn btn-sm btn-soft-warning" title="Edit"><i class="bi bi-pencil-square"></i></a>
    <form action="{{ $hapus }}" method="POST" class="form-hapus">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-soft-danger" title="Hapus"><i class="bi bi-trash3"></i></button>
    </form>
</div>