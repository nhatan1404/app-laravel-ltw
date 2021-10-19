@extends('admin.layouts.app')
@section('content')
<div class="row">
  <div class="col-lg-10 mx-auto">
    <div class="card">
      <h5 class="card-header">Tạo Danh Mục</h5>
      <div class="card-body">
        <form method="post" action="{{route('category.store')}}">
          {{csrf_field()}}
          <div class="form-group">
            <label for="inputTitle" class="col-form-label">Tiêu đề: <span class="text-danger">*</span></label>
            <input id="inputTitle" type="text" name="title" placeholder="Nhập tiêu đề" value="{{old('title')}}" class="form-control">
            @error('title')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="inputDescription" class="col-form-label">Mô tả: </label>
            <textarea class="form-control" id="inputDescription" name="description">{{old('description')}}</textarea>
            @error('description')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group {{(count($parentCategories) == 0) ? 'd-none' : ''}}">
            <label for="parent_id">Danh Mục Lớn: <small>(tuỳ chọn)</small></label>
            <select name="parent_id" class="form-control">
              <option value="">Chọn danh mục</option>
              @foreach($parentCategories as $key=>$parentCategory)
              <option value='{{$parentCategory->id}}'>{{$parentCategory->title}}</option>
              @endforeach
            </select>
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