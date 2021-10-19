@extends('admin.layouts.app')
@section('content')
<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Tạo Mã Giảm Giá</h5>
      <div class="card-body">
        <form method="post" action="{{route('voucher.store')}}">
          {{csrf_field()}}
          <div class="form-group">
            <label for="inputCode" class="col-form-label">Mã: <span class="text-danger">*</span></label>
            <input id="inputCode" type="text" name="code" placeholder="Nhập mã" value="{{old('code')}}" class="form-control">
            @error('code')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="inputType" class="col-form-label">Loại: <span class="text-danger">*</span></label>
            <select id="inputType" name="type" class="form-control">
              <option value="fixed">Giá tiền</option>
              <option value="percent">Phần trăm</option>
            </select>
            @error('type')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="inputValue" class="col-form-label">Giá trị: <span class="text-danger">*</span></label>
            <input id="inputValue" type="number" name="value" placeholder="Nhập giá trị" value="{{old('value')}}" class="form-control">
            @error('value')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="inputStatus" class="col-form-label">Trạng thái: <span class="text-danger">*</span></label>
            <select id="inputStatus" name="status" class="form-control">
              <option value="active">Còn hiệu lực</option>
              <option value="inactive">Hết hạn</option>
            </select>
            @error('status')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group mb-3">
            <button type="reset" class="btn btn-warning">Xoá</button>
            <button class="btn btn-success" type="submit">Tạo</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
  $('#lfm').filemanager('image');

  $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
      tabsize: 2,
      height: 150
    });
  });
</script>
@endpush