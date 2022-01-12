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

        <x-Admin.Form.InputImage name="Ảnh đại diện" property="avatar" :value="old('avatar')" />

        <div class="row">
            <div class="col">
                <x-Admin.Form.Select name="Chức vụ" property="role">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                            {{ Helpers::getRoleValue($role) }}</option>
                    @endforeach
                </x-Admin.Form.Select>
            </div>
            <div class="col">
                <x-Admin.Form.Select name="Trạng thái" property="status">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ old('status') == 'active' ? 'selected' : '' }}>Không hoạt động</option>
                </x-Admin.Form.Select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <x-Admin.Form.Input name="Địa chỉ" property="address" type="text" placeholder="Nhập địa chỉ"
                    value="{{ old('address') }}" />
            </div>
            <div class="col mt-2">
                <x-Admin.Form.Select name="Tỉnh" property="province">
                    @foreach (Helpers::getAllProvince() as $province)
                        <option value="{{ $province->id }}" {{ old('province') == $province->id ? 'selected' : '' }}>
                            {{ $province->name_with_type }}</option>
                    @endforeach
                </x-Admin.Form.Select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-Admin.Form.Select name="Thành phố/quận" property="district">
                    <option value="">Chọn thành phố/quận</option>
                    @if (old('province') && old('district'))
                        @foreach (Helpers::getDistricts(old('province')) as $district)
                            <option value="{{ $district->id }}"
                                {{ $district->id == old('district') ? ' selected' : '' }}>
                                {{ $district->name_with_type }}</option>
                        @endforeach
                    @endif
                </x-Admin.Form.Select>
            </div>
            <div class="col">
                <x-Admin.Form.Select name="Phường/Xã" property="ward">
                    <option value="">Chọn phường xã</option>
                    @if (old('province') && old('district') && old('ward'))
                        @foreach (Helpers::getWards(old('district')) as $ward)
                            <option value="{{ $ward->id }}" {{ $ward->id == old('ward') ? ' selected' : '' }}>
                                {{ $ward->name_with_type }}</option>
                        @endforeach
                    @endif
                </x-Admin.Form.Select>
            </div>
        </div>
    </x-Admin.Form.Create>
@endsection

@push('scripts')
    <script>
        $('#lfm').filemanager();
    </script>
@endpush
