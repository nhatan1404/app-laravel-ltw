@extends('admin.layouts.app')
@section('title', 'Tạo Bài Viết')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <h5 class="card-header">Tạo Bài Viết</h5>
                <div class="card-body">
                    <form method="post" action="{{ route('posts.store') }}">
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
                            <label for="inputDescription" class="col-form-label">Mô tả:</label>
                            <textarea class="form-control" id="inputDescription" placeholder="Nhập mô tả"
                                name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputContent" class="col-form-label">Nội dung: </label>
                            <textarea class="form-control" id="inputContent" rows="10" placeholder="Nhập nội dung"
                                name="content">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputCategory">Danh mục: <span class="text-danger">*</span></label>
                            <select name="category_id" id="inputCategory" class="form-control">
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $parent)
                                    <optgroup label="{{ $parent->title }}">
                                        @foreach ($parent->children as $children)
                                            <option value="{{ $children->id }}">{{ $children->title }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="added_by">Tác giả:</label>
                            <select name="user_id" class="form-control">
                                <option value="">Chọn tác giả</option>
                                @foreach ($users as $key => $data)
                                    <option value='{{ $data->id }}'
                                        {{ $data->id == $current_user ? 'selected' : '' }}>
                                        {{ $data->fullname }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputThumbnail" class="col-form-label">Thumbnail:</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="inputThumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fas fa-upload"></i> Chọn
                                    </a>
                                </span>
                                <input id="inputThumbnail" class="form-control" type="text" name="thumbnail"
                                    value="{{ old('thumbnail') }}">
                            </div>
                            <img id="holder" style="margin-top:15px;max-height:100px;">
                            @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-form-label">Trạng thái: <span
                                    class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="active">Hiển thị</option>
                                <option value="inactive">Ẩn</option>
                            </select>
                            @error('status')
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

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager();
    </script>
@endpush
