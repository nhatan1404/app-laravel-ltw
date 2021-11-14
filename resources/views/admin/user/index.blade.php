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
        '' => '',
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
                <td>{{ ucwords($user->role) }}</td>
                <td>
                    @if ($user->status == 'active')
                        <span class="badge badge-success">{{ $user->status }}</span>
                    @else
                        <span class="badge badge-warning">{{ $user->status }}</span>
                    @endif
                </td>
                <td>
                    <x-Admin.ButtonAction :id="$user->id" edit="user.edit" delete="user.destroy" />
                </td>
            </tr>
        @endforeach
    </x-Admin.Table>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/css/sweetalert2.min.css') }}" />
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }

    </style>
@endpush

@push('scripts')
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('#user-dataTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": [5, 6]
            }]
        });
    </script>
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
@endpush
