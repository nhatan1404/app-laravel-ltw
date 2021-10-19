@extends('auth.layouts.app')

@section('content')
<div class="container-xl px-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <!-- Basic verify email form-->
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header justify-content-center">
                    <div class="fw-light my-4">Xác Thực Địa Chỉ Email</div>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        Một liên kết xác minh đã được gửi đến địa chỉ email của bạn.
                    </div>
                    @endif

                    {{ __('Trước khi tiếp tục, vui lòng kiểm tra email của bạn để xác nhận liên kết xác minh.') }}
                    {{ __('Nếu bạn không nhận được email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Gửi lại</button>.
                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="small"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection