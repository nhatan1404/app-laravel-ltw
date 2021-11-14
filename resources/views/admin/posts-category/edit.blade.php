@extends('admin.layouts.app')
@section('title', 'Sửa Danh Mục Bài Viết')
@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <h5 class="card-header">Sửa Danh Mục Bài Viết</h5>
                <div class="card-body">
                    <form method="post" action="{{ route('posts-category.update', $posts_category->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Tiêu đề: <span
                                    class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Nhập tiêu đề"
                                value="{{ $posts_category->title }}" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputDescription" class="col-form-label">Mô tả: </label>
                            <textarea class="form-control" id="inputDescription"
                                name="description">{{ $posts_category->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group {{ $posts_category->parent_id == null ? 'd-none' : '' }}">
                            <label for="parent_id">Danh Mục Cha: <small>(tuỳ chọn)</small></label>
                            <select name="parent_id" class="form-control">
                                <option value="">Chọn danh mục</option>
                                @foreach ($parent_categories as $key => $parent_category)
                                    <option value='{{ $parent_category->id }}'
                                        {{ $parent_category->id == $posts_category->parent_id ? 'selected' : '' }}>
                                        {{ $parent_category->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <button class="btn btn-success" type="submit">Cập Nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
    <script>
        $('#is_parent').change(function() {
            var is_checked = $('#is_parent').prop('checked');
            if (is_checked) {
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            } else {
                $('#parent_cat_div').removeClass('d-none');
            }
        })
    </script>
@endpush
