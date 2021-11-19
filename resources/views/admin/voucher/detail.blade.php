@extends('admin.layouts.app')
@section('title', 'Chi Tiết Mã Giảm Giá')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-2 font-weight-bold text-primary float-left">Mã Giảm Giá
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
                                    <td>{{ $voucher->id }}</td>
                                </tr>
                                <tr>
                                    <td>Mã</td>
                                    <td>{{ $voucher->code }}</td>
                                </tr>

                                <tr>
                                    <td>Loại</td>
                                    <td>{{ $voucher->type == 'fixed' ? 'Giá tiền' : 'Phần trăm' }}</td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td>{{ $voucher->status == 'active' ? 'Còn hiệu lực' : 'Hết hạn' }}</td>
                                </tr>

                                <tr>
                                    <td>Ngày tạo</td>
                                    <td>{{ $voucher->created_at->format('d-m-Y') }}
                                        - {{ $voucher->created_at->format('g: i a') }}</td>
                                </tr>
                                <tr>
                                    <td>Ngày cập nhật</td>
                                    <td>{{ $voucher->updated_at->format('d-m-Y') }}
                                        - {{ $voucher->updated_at->format('g: i a') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer d-flex">
                        <x-Admin.ButtonDetail :id="$voucher->id" edit="voucher.edit" delete="voucher.destroy" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
