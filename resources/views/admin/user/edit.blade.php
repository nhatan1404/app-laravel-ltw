@extends('admin.layouts.app')
@section('title', 'Sửa Tài Khoản')

@section('content')
    <x-Admin.Form.Edit name="Tài Khoản" route="user.update" :id="$user->id">
        <div class="row">
            <div class="col">
                <x-Admin.Form.Input name="Họ" property="lastname" placeholder="Nhập họ" value="{{ $user->lastname }}" />
            </div>
            <div class="col">
                <x-Admin.Form.Input name="Tên" property="firstname" placeholder="Nhập tên"
                    value="{{ $user->firstname }}" />
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-Admin.Form.Input name="Email" property="email" type="email" placeholder="Nhập email"
                    value="{{ $user->email }}" />
            </div>
            <div class="col">
                <x-Admin.Form.Input name="Điện Thoại" property="telephone" placeholder="Nhập số điện thoại"
                    value="{{ $user->telephone }}" />
            </div>
        </div>

        <x-Admin.Form.InputImage name="Ảnh đại diện" property="avatar" :value="$user->avatar" />

        <div class="row">
            <div class="col">
                <x-Admin.Form.Select name="Chức vụ" property="role">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>
                            {{ ucwords($role) }}</option>
                    @endforeach
                </x-Admin.Form.Select>
            </div>
            <div class="col">
                <x-Admin.Form.Select name="Trạng thái" property="status">
                    @foreach ($roles as $role)
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Không hoạt động
                        </option>
                    @endforeach
                </x-Admin.Form.Select>
            </div>
        </div>
    </x-Admin.Form.Edit>
@endsection

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager();
    </script>
@endpush
