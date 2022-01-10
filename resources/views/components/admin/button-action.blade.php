<a href="{{ route($show, $id) }}" class="btn btn-primary btn-sm float-left mr-1 btn-circle" data-toggle="tooltip"
    title="Xem" data-placement="bottom"><i class="fas fa-info-circle"></i></a>
<a href="{{ route($edit, $id) }}" class="btn btn-warning btn-sm float-left mr-1 btn-circle" data-toggle="tooltip"
    title="Sửa" data-placement="bottom"><i class="fas fa-edit"></i></a>
<form method="POST" action="{{ route($delete, [$id]) }}">
    @csrf
    @method('delete')
    <button class="btn btn-danger btn-sm btn-circle btnDelete" data-id="{{ $id }}" data-toggle="tooltip"
        data-placement="bottom" title="Xoá"><i class="fas fa-trash-alt"></i></button>
</form>
