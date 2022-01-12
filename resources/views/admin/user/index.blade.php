@extends('admin.layouts.app')
@section('title', 'Quản Lý Tài Khoản')

@section('content')
    @php
    $columns = [
        'id' => 'ID',
        'fullname' => 'Họ Tên',
        'email' => 'Email',
        'created_at' => 'Ngày Tạo',
        'role' => 'Chức Vụ',
        'status' => 'Trạng Thái',
        'action' => '',
    ];
    @endphp

    <x-Admin.Table name="tài khoản" :columns="$columns" create="user.create" :value="$users">
        @foreach ($users as $user)
            <tr>
                <td>
                    {{ $user->id }}
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        @if ($user->avatar)
                            <img class="rounded-circle" src="{{ $user->avatar }}" style="max-width:50px"
                                alt="{{ $user->photo }}">
                        @else
                            <img class="rounded-circle" src="{{ asset('/images/default-avatar.png') }}"
                                style="max-width:50px" alt="Avatar">
                        @endif
                        <span class="ml-2">{{ $user->lastname }}
                            {{ $user->firstname }}</span>
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : '' }}</td>
                <td>{{ Helpers::getRoleValue($user->role) }}</td>
                <td class="text-center">
                    @if ($user->status == 'active')
                        <span class="badge badge-success">Hoạt động</span>
                    @else
                        <span class="badge badge-warning">Khoá</span>
                    @endif
                </td>
                <td>
                    <x-Admin.ButtonAction :id="$user->id" show="user.show" edit="user.edit" delete="user.destroy" />
                </td>
            </tr>
        @endforeach
    </x-Admin.Table>
@endsection
