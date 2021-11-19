<a href="{{ route($edit, $id) }}" class="btn btn-success mr-2"><i class="fas fa-edit"></i>
    Sửa</a>
<form method="POST" action="{{ route($delete, [$id]) }}">
    @csrf
    @method('delete')
    <button class="btn btn-danger btnDelete" data-id="{{ $id }}" data-toggle="tooltip" data-placement="bottom"
        title="Xoá"><i class="fas fa-trash-alt"> Xoá</i></button>
</form>
