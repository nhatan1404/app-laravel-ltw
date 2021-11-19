@extends('shop.layouts.app')
@section('title', 'Thông tin tài khoản')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="row">
                    <div class="col mt-3 mb-3">
                        <div class="card">
                            <div class="card-header cart-empty">
                                <h3 class="mb-0">Thông tin tài khoản</h3>
                            </div>
                            <div class="card-body">
                                <div class="e-profile">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3">
                                            <div class="mx-auto" style="width: 140px;">
                                                <img class="d-flex img-fluid justify-content-center align-items-center rounded"
                                                    src="{{ $user->avatar }}" />
                                            </div>
                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap" style="color:#000000">
                                                    {{ $user->fullname }}</h4>
                                                <p class="mb-0">{{ $user->email }}</p>
                                                <div class="mt-2">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fa fa-fw fa-camera"></i>
                                                        <input type="file" class="btn-change-photo position-absolute ">Chọn
                                                        ảnh
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="text-center text-sm-right">
                                                <span class="badge badge-secondary">{{ $user->role }}</span>
                                                <div class="text-muted">
                                                    <small>{{ date('d/m/Y', strtotime($user->created_at)) }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href="" class="active nav-link">Cài Đặt</a></li>
                                    </ul>
                                    <div class="tab-content pt-3">
                                        <div class="tab-pane active">
                                            <form class="form" novalidate="">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Họ: </label>
                                                                    <input class="form-control" type="text" name="name"
                                                                        placeholder="{{ $user->lastname }}"
                                                                        value="{{ $user->lastname }}">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Tên: </label>
                                                                    <input class="form-control" type="text"
                                                                        name="username"
                                                                        placeholder="{{ $user->firstname }}"
                                                                        value="{{ $user->firstname }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input class="form-control" type="text"
                                                                        placeholder="{{ $user->email }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <div class="form-group">
                                                                    <label>Số điện thoại</label>
                                                                    <input class="form-control" type="text"
                                                                        placeholder="{{ $user->telephone }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <div class="form-group">
                                                                    <label>Chi tiết địa chỉ:</label>
                                                                    <input class="form-control" type="text"
                                                                        placeholder="{{ $user->address->address }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 mb-3">
                                                        <div class="mb-2"><b>Đổi mật khẩu</b></div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Mật khẩu hiện tại</label>
                                                                    <input class="form-control" type="password"
                                                                        placeholder="••••••">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Mật khẩu mới</label>
                                                                    <input class="form-control" type="password"
                                                                        placeholder="••••••">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Xác nhận mật khẩu <span
                                                                            class="d-none d-xl-inline">Mật
                                                                            khẩu</span></label>
                                                                    <input class="form-control" type="password"
                                                                        placeholder="••••••">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 mb-3">
                                                        <div class="mb-2"><b>Địa chỉ</b></div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="country">Tỉnh: </label>
                                                                <select name="province" id="province"
                                                                    class="form-control mb-3">
                                                                    <option value="">Chọn tỉnh</option>
                                                                    @foreach (Helpers::getAllProvince() as $province)
                                                                        <option value="{{ $province->id }}"
                                                                            {{ $province->id == $user->address->province->id ? ' selected' : '' }}>
                                                                            {{ $province->name_with_type }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="country">Thành phố/Quận: </label>
                                                                <select name="district" id="district"
                                                                    class="form-control mb-3">
                                                                    @foreach (Helpers::getDistricts($user->address->province->id) as $district)
                                                                        <option value="{{ $district->id }}"
                                                                            {{ $district->id == $user->address->district->id ? ' selected="selected"' : '' }}>
                                                                            {{ $district->name_with_type }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="country">Phường/Xã: </label>
                                                                <select name="ward" id="ward" class="form-control">
                                                                    @foreach (Helpers::getWards($user->address->district->id) as $ward)
                                                                        <option value="{{ $ward->id }}"
                                                                            {{ $ward->id == $user->address->ward->id ? ' selected' : '' }}>
                                                                            {{ $ward->name_with_type }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                                        </div>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
