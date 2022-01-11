<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <h5 class="card-header">Tạo {{ $name }}</h5>
            <div class="card-body">
                <form method="post" action="{{ route($route) }}">
                    {{ csrf_field() }}
                    {{ $slot }}
                    <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">Tạo</button>
                        <button type="reset" class="btn btn-warning">Xoá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
