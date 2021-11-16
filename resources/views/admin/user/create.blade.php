@extends('admin.layouts.app')
@section('title', 'Tạo Tài Khoản')

@section('content')
    <x-Admin.Form.Create name="Tài Khoản" route="user.store">
        <div class="row">
            <div class="col">
                <x-Admin.Form.Input name="Họ" property="lastname" placeholder="Nhập họ" value="{{ old('lastname') }}" />
            </div>
            <div class="col">
                <x-Admin.Form.Input name="Tên" property="firstname" placeholder="Nhập tên"
                    value="{{ old('firstname') }}" />
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-Admin.Form.Input name="Email" property="email" type="email" placeholder="Nhập email"
                    value="{{ old('email') }}" />
            </div>
            <div class="col">
                <x-Admin.Form.Input name="Điện Thoại" property="telephone" placeholder="Nhập số điện thoại"
                    value="{{ old('telephone') }}" />
            </div>
        </div>

        <x-Admin.Form.InputImage name="Ảnh đại diện" property="avatar" :value="old('avatar')"/>

        <div class="row">
            <div class="col">
                <x-Admin.Form.Select name="Chức vụ" property="role">
                    @foreach ($roles as $role)
                        <option value="admin">Admin</option>
                        <option value="employee">Nhân Viên</option>
                        <option value="customer">Khách Hàng</option>
                    @endforeach
                </x-Admin.Form.Select>
            </div>
            <div class="col">
                <x-Admin.Form.Select name="Trạng thái" property="status">
                    @foreach ($roles as $role)
                        <option value="active">Hoạt động</option>
                        <option value="inactive">Không hoạt động</option>
                    @endforeach
                </x-Admin.Form.Select>
            </div>
        </div>
    </x-Admin.Form.Create>
@endsection

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager();
    </script>
@endpush
