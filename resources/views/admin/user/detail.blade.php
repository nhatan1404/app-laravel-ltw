@extends('admin.layouts.app')
@section('title', 'Chi Tiết Tài Khoản')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-2 font-weight-bold text-primary float-left">Tài Khoản
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-sm-3">#</th>
                                    <th class="col-sm-9">Thông tin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <td>Ảnh đại diện</td>
                                    <td><img class="img-thumbnail" style="width: 144px" src="{{ $user->avatar }}" /> </td>
                                </tr>
                                <tr>
                                    <td>Họ</td>
                                    <td>{{ $user->lastname }}</td>
                                </tr>

                                <tr>
                                    <td>Tên</td>
                                    <td>{{ $user->firstname }}</td>
                                </tr>

                                <tr>
                                    <td>Email</td>
                                    <td>{{ $user->email }}</td>
                                </tr>

                                <tr>
                                    <td>Số điện thoại</td>
                                    <td>{{ $user->telephone }}</td>
                                </tr>

                                @if ($user->address)
                                    <tr>
                                        <td>Địa chỉ</td>
                                        <td>{{ $user->address->address }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Vai trò</td>
                                    <td>
                                        @if ($user->role == 'admin')
                                            Admin
                                        @elseif($user->role == 'employee')
                                            Nhân viên
                                        @else
                                            Khách hàng
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td>{{ $user->status == 'active' ? 'Hoạt động' : 'Không hoạt động' }}</td>
                                </tr>

                                <tr>
                                    <td>Ngày tạo</td>
                                    <td>{{ $user->created_at->format('d-m-Y') }}
                                        - {{ $user->created_at->format('g: i a') }}</td>
                                </tr>
                                <tr>
                                    <td>Ngày cập nhật</td>
                                    <td>{{ $user->updated_at->format('d-m-Y') }}
                                        - {{ $user->updated_at->format('g: i a') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer d-flex">
                        <x-Admin.ButtonDetail :id="$user->id" edit="user.edit" delete="user.destroy" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
