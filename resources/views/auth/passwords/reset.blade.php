@extends('auth.layouts.app')
@section('title', 'Đặt Lại Mật Khẩu')
@section('content')
<div class="container-xl px-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <!-- Basic reset password form-->
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header justify-content-center">
                    <h3 class="fw-light my-4">Đặt Lại Mật KHẩu</h3>
                </div>

                <div class="card-body">
                    <!-- Reset password form -->
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="inputEmailAddress" type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="Nhập địa chỉ email" autocomplete="email" autofocus />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Form Group (password)-->
                        <div class="mb-3">
                            <label for="inputPassword" class="small mb-1">Mật Khẩu: </label>
                            <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" name="password" placeholder="Nhập mật khẩu" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Form Group (confirm password)-->
                        <div class="mb-3">
                            <label for="password-confirm" class="small mb-1">Xác Nhận Mật Khẩu: </label>
                            <input class="form-control" id="password-confirm" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required autocomplete="new-password">
                        </div>

                        <div class="d-flex align-items-center justify-content-between form-group row mt-4 mb-0">
                            <button type="submit" class="btn btn-primary">
                                Đặt Lại Mật Khẩu
                            </button>
                        </div>
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