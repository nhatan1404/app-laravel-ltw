@extends('auth.layouts.app')
@section('title', 'Đăng Ký')

@section('content')
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <!-- Basic registration form-->
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light my-4">Đăng Ký</h3>
                    </div>
                    <div class="card-body">
                        <!-- Registration form-->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- Form Row-->
                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <!-- Form Group (last name)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputLastName">Họ: </label>
                                        <input class="form-control @error('lastname') is-invalid @enderror"
                                            id="inputLastName" name="lastname" type="text" placeholder="Nhập họ"
                                            value="{{ old('lastname') }}" required autocomplete="lastname" autofocus />
                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Form Group (first name)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputFirstName">Tên: </label>
                                        <input class="form-control @error('firstname') is-invalid @enderror"
                                            id="inputFirstName" name="firstname" type="text" placeholder="Nhập tên"
                                            value="{{ old('firstname') }}" required autocomplete="firstname" autofocus />
                                        @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Form Group (email address)            -->
                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputEmailAddress">Email: </label>
                                        <input class="form-control @error('email') is-invalid @enderror"
                                            id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp"
                                            placeholder="Nhập email" value="{{ old('email') }}" required
                                            autocomplete="email" autofocus />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputTelephone">Số Điện Thoại: </label>
                                        <input class="form-control @error('telephone') is-invalid @enderror"
                                            id="inputTelephone" name="telephone" type="text"
                                            placeholder="Nhập số điện thoại" value="{{ old('telephone') }}" required
                                            autocomplete="email" autofocus />
                                        @error('telephone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Form Row    -->
                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <!-- Form Group (password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputPassword">Mật Khẩu: </label>
                                        <input class="form-control @error('password') is-invalid @enderror"
                                            id="inputPassword" type="password" name="password" placeholder="Nhập mật khẩu"
                                            required autocomplete="new-password" />
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Form Group (confirm password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputConfirmPassword">Mật Khẩu:</label>
                                        <input class="form-control" id="inputConfirmPassword" type="password"
                                            name="password_confirmation" placeholder="Nhập lại mật khẩu" required
                                            autocomplete="new-password" />
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <!-- Form Group (password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputAddress">Địa Chỉ: </label>
                                        <input class="form-control @error('address') is-invalid @enderror" id="inputAddress"
                                            type="text" name="address" placeholder="Nhập địa chỉ" required />
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="province">Tỉnh:</label>
                                        <select name="province" id="province"
                                            class="form-control mb-3 @error('province') is-invalid @enderror" required>
                                            <option value="">Chọn tỉnh</option>
                                            @foreach (Helpers::getAllProvince() as $province)
                                                <option value="{{ $province->id }}">
                                                    {{ $province->name_with_type }}</option>
                                            @endforeach
                                        </select>
                                        @error('province')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="district">Thành phố/quận:</label>
                                        <select name="district" id="district"
                                            class="form-control mb-3 @error('district') is-invalid @enderror" required>
                                            <option value="">Chọn thành phố/quận</option>
                                        </select>
                                        @error('district')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="small mb-1" for="ward">Phường/Xã:</label>
                                        <select name="ward" id="ward"
                                            class="form-control mb-3 @error('ward') is-invalid @enderror" required>
                                            <option value="">Chọn phường xã</option>
                                        </select>
                                        @error('ward')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Form Group (create account submit)-->
                            <button class="btn btn-primary btn-block" type="submit">Đăng Ký</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small"><a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('shop/js/jquery.min.js') }}"></script>
    <script>
        $("#province").change(function() {
            const id = $(this).find("option:selected").val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "get",
                url: `${window.location.origin}/address/districts/${id}`,
                success: function(data) {
                    const {
                        districts
                    } = data;
                    const districtSelect = $("#district");
                    districtSelect.empty();

                    const wardSelect = $("#ward");
                    wardSelect.empty();

                    districtSelect.append(
                        '<option value="">Chọn thành phố/quận</option>'
                    );

                    wardSelect.append('<option value="">Chọn phường/xã</option>');

                    districts.forEach((district) => {
                        districtSelect.append(
                            `<option value="${district.id}">${district.name}</option>`
                        );
                    });
                },
                error: function(error) {
                    if (error.status === 401) {
                        window.location.href = "/login";
                        return;
                    }
                },
            });
        });

        $("#district").change(function() {
            const id = $(this).find("option:selected").val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "get",
                url: `${window.location.origin}/address/wards/${id}`,
                success: function(data) {
                    const {
                        wards
                    } = data;
                    const wardSelect = $("#ward");
                    wardSelect.empty();
                    wardSelect.append('<option value="">Chọn phường/xã</option>');

                    wards.forEach((ward) => {
                        wardSelect.append(
                            `<option value="${ward.id}">${ward.name_with_type}</option>`
                        );
                    });
                },
                error: function(error) {

                },
            });
        });
    </script>
@endpush
