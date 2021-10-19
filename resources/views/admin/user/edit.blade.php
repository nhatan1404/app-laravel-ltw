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
                <input id="inputTelephone" type="text" name="phone" placeholder="Nhập số điện thoại" value="{{$user->telephone}}" class="form-control">
                @error('telephone')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
          </div>

          <!-- <div class="form-group">
            <label for="inputPassword" class="col-form-label">Password</label>
            <input id="inputPassword" type="password" name="password" placeholder="Enter password" value="{{$user->password}}" class="form-control">
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div> -->

          <div class="form-group">
            <label for="inputPhoto" class="col-form-label">Photo</label>
            <div class="input-group">
              <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                </a>
              </span>
              <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$user->avatar}}">
            </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
            @error('photo')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          @php
          $roles=DB::table('users')->select('role')->where('id',$user->id)->get();
          // dd($roles);
          @endphp
          <div class="form-group">
            <label for="role" class="col-form-label">Role</label>
            <select name="role" class="form-control">
              <option value="">-----Select Role-----</option>
              @foreach($roles as $role)
              <option value="{{$role->role}}" {{(($role->role=='admin') ? 'selected' : '')}}>Admin</option>
              <option value="{{$role->role}}" {{(($role->role=='user') ? 'selected' : '')}}>User</option>
              @endforeach
            </select>
            @error('role')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">Status</label>
            <select name="status" class="form-control">
              <option value="active" {{(($user->status=='active') ? 'selected' : '')}}>Active</option>
              <option value="inactive" {{(($user->status=='inactive') ? 'selected' : '')}}>Inactive</option>
            </select>
            @error('status')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="role" class="col-form-label">Chức Vụ:</label>
                <select name="role" class="form-control">
                  <option value="">Chọn chức vụ</option>
                  <option value="admin" {{(($role->role=='admin') ? 'selected' : '')}}>Admin</option>
                  <option value="employee" {{(($role->role=='employee') ? 'selected' : '')}}>Nhân Viên</option>
                  <option value="customer" {{(($role->role=='customer') ? 'selected' : '')}}>Khách Hàng</option>
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
  $('#lfm').filemanager('image');
</script>
@endpush