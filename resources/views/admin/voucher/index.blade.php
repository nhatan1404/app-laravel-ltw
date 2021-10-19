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
      <h6 class="m-2 font-weight-bold text-primary float-left">Danh Sách Mã Giảm Giá</h6>
      <a href="{{route('voucher.create')}}" class="btn btn-success btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Tạo Mã Giảm Giá"><i class="fas fa-plus"></i> Tạo Mới</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($vouchers)>0)
        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Mã</th>
              <th>Loại</th>
              <th>Giá Trị</th>
              <th>Trạng Thái</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($vouchers as $voucher)
            <tr>
              <td>{{$voucher->id}}</td>
              <td>{{$voucher->code}}</td>
              <td>
                @if($voucher->type=='fixed')
                <span class="badge badge-primary">Giá tiền</span>
                @else
                <span class="badge badge-warning">Phần trăm</span>
                @endif
              </td>
              <td>
                @if($voucher->type=='fixed')
                ${{number_format($voucher->value,2)}}
                @else
                {{$voucher->value}}%
                @endif
              </td>
              <td>
                @if($voucher->status=='active')
                <span class="badge badge-success">Còn hiệu lực</span>
                @else
                <span class="badge badge-warning">Hết hạn</span>
                @endif
              </td>
              <td>
                <a href="{{route('voucher.edit',$voucher->id)}}" class="btn btn-info btn-sm float-left mr-1 btn-action" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{route('voucher.destroy',[$voucher->id])}}">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger btn-sm btn-action" data-id="{{$voucher->id}}" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$vouchers->links()}}</span>
        @else
        <h6 class="text-center">Danh sách mã giảm giá trống.</h6>
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