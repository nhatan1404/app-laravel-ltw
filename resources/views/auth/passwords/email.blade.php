@extends('auth.layouts.app')
@section('title', 'Khôi Phục Mật Khẩu')

@section('content')
<div class="container-xl px-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <!-- Basic forgot password form-->
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header justify-content-center">
                    <h3 class="fw-light my-4">Khôi Phục Mật Khẩu</h3>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="small mb-3 text-muted">Nhập địa chỉ email và chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu.</div>
                    <!-- Forgot password form-->
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email: </label>
                            <input class="form-control @error('email') is-invalid @enderror" id="inputEmailAddress" type="email" name="email" aria-describedby="emailHelp" placeholder="Nhập địa chỉ email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Form Group (submit options)-->
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="{{route('login')}}">Quay lại trang đăng nhập</a>
                            <button class="btn btn-primary" type="submit">Gửi</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <div class="small"><a href="{{route('register')}}">Chưa có tài khoản? Đăng ký!</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection