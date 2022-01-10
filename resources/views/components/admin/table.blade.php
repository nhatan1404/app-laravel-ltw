<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('admin.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="mt-2 font-weight-bold text-primary float-left">Danh Sách {{ ucwords($name) }}</h6>
            <a href="{{ route($create) }}" class="btn btn-success btn-sm float-right" data-toggle="tooltip"
                data-placement="bottom" title="Tạo {{ $name }}"><i class="fas fa-plus"></i> Tạo Mới</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (count($value) > 0)
                    <table class="table table-bordered" id="dataTableCategory" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @foreach ($columns as $column)
                                    <th>{{ $column }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            {{ $slot }}
                        </tbody>
                    </table>
                    <span style="float:right">{{ $value->links('vendor.pagination.bootstrap-4') }}</span>
                @else
                    <h6 class="text-center">Danh sách {{ $name }} trống.</h6>
                @endif
            </div>

        </div>
    </div>
</div>
<!-- End Page Content -->
