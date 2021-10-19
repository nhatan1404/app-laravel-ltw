@extends('admin.layouts.app')
@section('title', 'Tạo tài khoản')

@section('content')

<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Tạo Tài Khoản</h5>
      <div class="card-body">
        <form method="post" action="{{route('user.store')}}">
          {{csrf_field()}}

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputLastname" class="col-form-label">Họ: </label>
                <input id="inputLastname" type="text" name="lastname" placeholder="Nhập họ" value="{{old('lastname')}}" class="form-control">
                @error('lastname')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputFirstname" class="col-form-label">Tên: </label>
                <input id="inputFirstname" type="text" name="firstname" placeholder="Nhập tên" value="{{old('firstname')}}" class="form-control">
                @error('firstname')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputEmail" class="col-form-label">Email: </label>
                <input id="inputEmail" type="email" name="email" placeholder="Nhập email" value="{{old('email')}}" class="form-control">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label for="inputTelephone" class="col-form-label">Điện Thoại:</label>
                <input id="inputTelephone" type="text" name="phone" placeholder="Nhập số điện thoại" value="{{old('telephone')}}" class="form-control">
                @error('telephone')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword" class="col-form-label">Mật Khẩu:</label>
            <input id="inputPassword" type="password" name="password" placeholder="Nhập mật khẩu" value="{{old('password')}}" class="form-control">
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="inputPhoto" class="col-form-label">Ảnh Đại Diện:</label>
            <div class="input-group">
              <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                </a>
              </span>
              <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
            </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
            @error('photo')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="role" class="col-form-label">Chức Vụ:</label>
                <select name="role" class="form-control">
                  <option value="">Chọn chức vụ</option>
                  <option value="admin">Admin</option>
                  <option value="employee">Nhân Viên</option>
                  <option value="customer">Khách Hàng</option>
                </select>
                @error('role')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="status" class="col-form-label">Trạng thái: </label>
                <select name="status" class="form-control">
                  <option value="active">Hoạt động</option>
                  <option value="inactive">Không hoạt động</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <button type="reset" class="btn btn-warning">Reset</button>
            <button class="btn btn-success" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
  $('#lfm').filemanager('image');
</script>
@endpush