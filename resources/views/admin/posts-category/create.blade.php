@extends('admin.layouts.app')
@section('title', 'Tạo Danh Mục Bài Viết')
@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <h5 class="card-header">Tạo Danh Mục Bài Viết</h5>
                <div class="card-body">
                    <form method="post" action="{{ route('posts-category.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Tiêu đề: <span
                                    class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Nhập tiêu đề"
                                value="{{ old('title') }}" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputDescription" class="col-form-label">Mô tả: </label>
                            <textarea class="form-control" id="inputDescription"
                                name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group {{ count($parent_categories) == 0 ? 'd-none' : '' }}">
                            <label for="parent_id">Danh Mục Cha: <small>(tuỳ chọn)</small></label>
                            <select name="parent_id" class="form-control">
                                <option value="">Chọn danh mục</option>
                                @foreach ($parent_categories as $key => $parent_category)
                                    <option value='{{ $parent_category->id }}'>{{ $parent_category->title }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <button type="reset" class="btn btn-warning">Xoá</button>
                            <button class="btn btn-success" type="submit">Tạo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
