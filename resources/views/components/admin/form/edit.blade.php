<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <h5 class="card-header">Sửa {{ $name }}</h5>
            <div class="card-body">
                <form method="post" action="{{ route($route, $id) }}">
                    @csrf
                    @method('PATCH')
                    {{ $slot }}
                    <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">Cập Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
