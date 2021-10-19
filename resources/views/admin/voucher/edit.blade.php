@extends('admin.layouts.app')
@section('content')
<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Sửa Mã Giảm Giá</h5>
      <div class="card-body">
        <form method="post" action="{{route('voucher.update',$voucher->id)}}">
          @csrf
          @method('PATCH')
          <div class="form-group">
            <label for="inputCode" class="col-form-label">Mã: <span class="text-danger">*</span></label>
            <input id="inputCode" type="text" name="code" placeholder="Nhập mã" value="{{$voucher->code}}" class="form-control">
            @error('code')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="inputType" class="col-form-label">Loại: <span class="text-danger">*</span></label>
            <select id="inputType" name="type" class="form-control">
              <option value="fixed" {{(($voucher->type=='fixed') ? 'selected' : '')}}>Giá tiền</option>
              <option value="percent" {{(($voucher->type=='percent') ? 'selected' : '')}}>Phần trăm</option>
            </select>
            @error('type')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="inputValue" class="col-form-label">Giá Trị: <span class="text-danger">*</span></label>
            <input id="inputValue" type="number" name="value" placeholder="Nhập giá trị" value="{{$voucher->value}}" class="form-control">
            @error('value')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="inputStatus" class="col-form-label">Trạng Thái: <span class="text-danger">*</span></label>
            <select id="inputStatus" name="status" class="form-control">
              <option value="active" {{(($voucher->status=='active') ? 'selected' : '')}}>Còn hiệu lực</option>
              <option value="inactive" {{(($voucher->status=='inactive') ? 'selected' : '')}}>Hết hạn</option>
            </select>
            @error('status')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group mb-3">
            <button class="btn btn-success" type="submit">Cập Nhật</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection