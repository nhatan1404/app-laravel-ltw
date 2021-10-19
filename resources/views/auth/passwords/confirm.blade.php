@extends('auth.layouts.app')
@section('title', 'Xác Nhận Mật Khẩu')

@section('content')
<div class="container-xl px-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <!-- Basic confirm password form-->
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header justify-content-center">
                    <h3 class="fw-light my-4">Xác Nhận Mật Khẩu</h3>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="small mb-3 text-muted">Vui lòng nhập lại mật khẩu trước khi tiếp tục.</div>
                    <!-- Confirm password form-->
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <!-- Form Group (password)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPassword">Mật Khẩu: </label>
                            <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" name="password" placeholder="Nhập mật khẩu" required autocomplete="current-password" />
                            @error('password')
                            <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- Form Group (submit options)-->
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button class="btn btn-primary" type="submit">Xác Nhận</button>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Quên mật khẩu?
                            </a>
                            @endif
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