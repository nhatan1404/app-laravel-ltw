@extends('admin.layouts.app')
@section('title', 'Sửa Tài Khoản')
@section('content')

<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Sửa Tài Khoản</h5>
      <div class="card-body">
        <form method="post" action="{{route('user.update',$user->id)}}">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputLastname" class="col-form-label">Họ: </label>
                <input id="inputLastname" type="text" name="lastname" placeholder="Nhập họ" value="{{$user->lastname}}" class="form-control">
                @error('lastname')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputFirstname" class="col-form-label">Tên: </label>
                <input id="inputFirstname" type="text" name="firstname" placeholder="Nhập tên" value="{{$user->firstname}}" class="form-control">
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
                <input id="inputEmail" type="email" name="email" placeholder="Nhập email" value="{{$user->email}}" class="form-control">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label for="inputTelephone" class="col-form-label">Điện Thoại:</label>
                <input id="inputTelephone" type="text" name="telephone" placeholder="Nhập số điện thoại" value="{{$user->telephone}}" class="form-control">
                @error('telephone')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
          </div>

          {{-- <div class="form-group">
            <label for="inputPassword" class="col-form-label">Password</label>
            <input id="inputPassword" type="password" name="password" placeholder="Enter password" value="{{$user->password}}" class="form-control">
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>--}}

          <div class="form-group">
            <label for="inputAvatar" class="col-form-label">Ảnh Đại Diện: </label>
            <div class="input-group">
              <span class="input-group-btn">
                <a id="lfm" data-input="inputAvatar" data-preview="holder" class="btn btn-primary">
                  <i class="fas fa-upload"></i> Chọn
                </a>
              </span>
              <input id="inputAvatar" class="form-control" type="text" name="avatar" value="{{$user->avatar}}">
            </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
            @error('avatar')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
         
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="role" class="col-form-label">Chức Vụ:</label>
                <select name="role" class="form-control">
                  <option value="">Chọn chức vụ</option>
                  @foreach($roles as $role)
                  <option value="{{$role}}" {{(($user->role == $role) ? 'selected' : '')}}>{{ucwords($role)}}</option>
                  @endforeach
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
                  <option value="active" {{(($user->status=='active') ? 'selected' : '')}}>Hoạt động</option>
                  <option value="inactive" {{(($user->status=='inactive') ? 'selected' : '')}}>Không hoạt động</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <button class="btn btn-success" type="submit">Update</button>
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
  $('#lfm').filemanager();
</script>
@endpush