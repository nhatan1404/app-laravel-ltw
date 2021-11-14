@extends('admin.layouts.app')
@section('title', 'Sửa Bài Viết')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <h5 class="card-header">Tạo Bài Viết</h5>
                <div class="card-body">
                    <form method="post" action="{{ route('posts.update', $posts->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Tiêu đề: <span
                                    class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Nhập tiêu đề"
                                value="{{ $posts->title }}" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputDescription" class="col-form-label">Mô tả:</label>
                            <textarea class="form-control" id="inputDescription" placeholder="Nhập mô tả"
                                name="description">{{ $posts->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputContent" class="col-form-label">Nội dung: </label>
                            <textarea class="form-control" id="inputContent" rows="10" placeholder="Nhập nội dung"
                                name="content">{{ $posts->content }}</textarea>
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
                                            <option value="{{ $children->id }}"
                                                {{ $posts->category->id == $children->id ? ' selected' : '' }}>
                                                {{ $children->title }}</option>
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
                                        {{ $data->id == $posts->author->id ? 'selected' : '' }}>
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
                                    value="{{ $posts->thumbnail }}">
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
                                <option value="active" {{ $posts->status == 'active' ? ' selected' : '' }}>Hiển thị
                                </option>
                                <option value="inactive" {{ $posts->status == 'inactive' ? ' selected' : '' }}>Ẩn
                                </option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-success" type="submit">Cập nhật</button>
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
