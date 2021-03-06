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

        <div class="row">
            <div class="col">
                <x-Admin.Form.Input name="Mật khẩu" property="password" type="password" placeholder="Nhập mật khẩu"
                    value="" />
            </div>
            <div class="col">
                <x-Admin.Form.Input name="Xác nhận mật khẩu" property="repassword" type="password"
                    placeholder="Nhập lại mật khẩu" value="" />
            </div>
        </div>

        <x-Admin.Form.InputImage name="Ảnh đại diện" property="avatar" :value="$user->avatar" />

        <div class="row">
            <div class="col">
                <x-Admin.Form.Select name="Chức vụ" property="role">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>
                            {{ Helpers::getRoleValue($role) }}</option>
                    @endforeach
                </x-Admin.Form.Select>
            </div>
            <div class="col">
                <x-Admin.Form.Select name="Trạng thái" property="status">
                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Khoá</option>
                </x-Admin.Form.Select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-Admin.Form.Input name="Địa chỉ" property="address" type="text" placeholder="Nhập địa chỉ"
                    value="{{ $user->address ? $user->address->address : '' }}" />
            </div>
            <div class="col mt-2">
                <x-Admin.Form.Select name="Tỉnh" property="province">
                    @foreach (Helpers::getAllProvince() as $province)
                        <option value="{{ $province->id }}"
                            {{ $user->address && $user->address->province->id == $province->id ? ' selected' : '' }}>
                            {{ $province->name_with_type }}</option>
                    @endforeach
                </x-Admin.Form.Select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-Admin.Form.Select name="Thành phố/quận" property="district">
                    @if ($user->address)
                        @foreach (Helpers::getDistricts($user->address->province->id) as $district)
                            <option value="{{ $district->id }}"
                                {{ $district->id == $user->address->district->id ? ' selected' : '' }}>
                                {{ $district->name_with_type }}</option>
                        @endforeach
                    @endif
                </x-Admin.Form.Select>
            </div>
            <div class="col">
                <x-Admin.Form.Select name="Phường/Xã" property="ward">
                    @if ($user->address)
                        @foreach (Helpers::getWards($user->address->district->id) as $ward)
                            <option value="{{ $ward->id }}"
                                {{ $ward->id == $user->address->ward->id ? ' selected' : '' }}>
                                {{ $ward->name_with_type }}</option>
                        @endforeach
                    @endif
                </x-Admin.Form.Select>
            </div>
        </div>
    </x-Admin.Form.Edit>
@endsection

@push('scripts')
    <script>
        $('#lfm').filemanager();
    </script>
@endpush
