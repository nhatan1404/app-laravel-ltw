@extends('admin.layouts.app')
@section('title', 'Sửa Sản Phẩm')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <h5 class="card-header"> Sửa Sản Phẩm</h5>
                <div class="card-body">
                    <form method="post" action="{{ route('product.update', $product->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Tên: <span class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Nhập tên sản phẩm"
                                value="{{ $product->title }}" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputDescription" class="col-form-label">Mô tả: <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="inputDescription" placeholder="Nhập mô tả"
                                name="description">{{ $product->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputDiscount" class="col-form-label">Chiết khấu(%): </label>
                            <input id="inputDiscount" type="number" name="discount" min="0" max="100"
                                placeholder="Nhập chiết khấu" value="{{ $product->discount }}" class="form-control">
                            @error('discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputQuantity">Số lượng: <span class="text-danger">*</span></label>
                            <input id="inputQuantity" type="number" name="quantity" min="0" placeholder="Nhập số lượng"
                                value="{{ $product->quantity }}" class="form-control">
                            @error('quantity')
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
                                                {{ $children->id == $product->category->id ? ' selected' : '' }}>
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
                            <label for="inputPrice" class="col-form-label">Giá: <span
                                    class="text-danger">*</span></label>
                            <input id="inputPrice" type="number" name="price" placeholder="Nhập giá"
                                value="{{ $product->price }}" class="form-control">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputImages" class="col-form-label">Ảnh: <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="images" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Chọn
                                    </a>
                                </span>
                                <input id="images" class="form-control" type="text" name="images"
                                    value="{{ $product->images }}">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            @error('images')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-form-label">Trạng Thái: <span
                                    class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $product->status == 'active' ? ' selected' : '' }}>Hiển thị
                                </option>
                                <option value="inactive" {{ $product->status == 'inactive' ? ' selected' : '' }}>Ẩn
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
