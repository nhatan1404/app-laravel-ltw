<a href="{{ route($edit, $id) }}" class="btn btn-info btn-sm float-left mr-1 btn-action" data-toggle="tooltip"
    title="Sửa" data-placement="bottom"><i class="fas fa-edit"></i></a>
<form method="POST" action="{{ route($delete, [$id]) }}">
    @csrf
    @method('delete')
    <button class="btn btn-danger btn-sm btn-action btnDelete" data-id="{{ $id }}" data-toggle="tooltip"
        data-placement="bottom" title="Xoá"><i class="fas fa-trash-alt"></i></button>
</form>
