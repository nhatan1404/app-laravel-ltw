@extends('admin.layouts.app')
@section('title', 'Danh Sách Mã Giảm Giá')

@section('content')
    @php
    $columns = [
        'id' => 'ID',
        'code' => 'Mã',
        'type' => 'Loại',
        'value' => 'Giá Trị',
        'status' => 'Trạng Thái',
        'action' => '',
    ];
    @endphp

    <x-Admin.Table name="mã giảm giá" :columns="$columns" create="voucher.create" :value="$vouchers">
        @foreach ($vouchers as $voucher)
            <tr>
                <td>{{ $voucher->id }}</td>
                <td>{{ $voucher->code }}</td>
                <td>
                    @if ($voucher->type == 'fixed')
                        <span class="badge badge-primary">Giá tiền</span>
                    @else
                        <span class="badge badge-warning">Phần trăm</span>
                    @endif
                </td>
                <td>
                    @if ($voucher->type == 'fixed')
                        ${{ number_format($voucher->value, 2) }}
                    @else
                        {{ $voucher->value }}%
                    @endif
                </td>
                <td>
                    @if ($voucher->status == 'active')
                        <span class="badge badge-success">Còn hiệu lực</span>
                    @else
                        <span class="badge badge-warning">Hết hạn</span>
                    @endif
                </td>
                <td>
                    <x-Admin.ButtonAction :id="$voucher->id"  show="voucher.show" edit="voucher.edit" delete="voucher.destroy" />
                </td>
            </tr>
        @endforeach
    </x-Admin.Table>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/css/sweetalert2.min.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
@endpush
