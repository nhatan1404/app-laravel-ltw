@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="row">
      <div class="col-md-12">
        @include('admin.layouts.notification')
      </div>
    </div>
    <div class="card-header py-3">
      <h6 class="mt-2 font-weight-bold text-primary float-left">Danh Sách Danh Mục</h6>
      <a href="{{route('category.create')}}" class="btn btn-success btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Tạo Danh Mục"><i class="fas fa-plus"></i> Tạo Mới</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($categories)>0)
        <table class="table table-bordered" id="dataTableCategory" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tiêu Đề</th>
              <th>Mô Tả</th>
              <th>Đường Dẫn</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($categories as $category)
            <tr>
              <td>{{$category->id}}</td>
              <td>{{$category->title}}</td>
              <td>{{$category->description}}</td>
              <td>{{$category->slug}}</td>
              </td>
              <td>
                <a href="{{route('category.edit',$category->id)}}" class="btn btn-warning btn-sm float-left mr-1 btn-action" data-toggle="tooltip" title="Sửa" data-placement="bottom"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{route('category.destroy',[$category->id])}}">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger btn-sm dltBtn btn-action" data-id="{{$category->id}}" data-toggle="tooltip" data-placement="bottom" title="Xoá"><i class="fas fa-trash-alt"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$categories->links()}}</span>
        @else
        <h6 class="text-center">Danh sách danh mục trống.</h6>
        @endif
      </div>
    </div>
  </div>
</div>
<!-- End Page Content -->
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.dltBtn').click(function(e) {
      const form = $(this).closest('form');
      const dataID = $(this).data('id');
      e.preventDefault();
      Swal.fire({
          title: "Bạn có muốn xoá?",
          text: "Sau khi xóa, bạn sẽ không thể khôi phục dữ liệu này!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Xác nhận',
          cancelButtonText: "Huỷ",
        })
        .then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
    })
  })
</script>
@endpush