@extends('admin.layouts.app')
@section('title', 'Danh Sách Danh Mục Sản Phẩm')

@section('content')
@php
$columns = [
'id' => 'ID',
'title' => 'Tiêu Đề',
'description' => 'Ảnh',
'slug' => 'Trạng Thái',
'action' => '',
];
@endphp

<x-Admin.Table name="banner" :columns="$columns" create="banner.create" :value="$banners">
  @foreach ($banners as $banner)
  <tr>
    <td>{{ $banner->id }}</td>
    <td>{{ $banner->title }}</td>
    <td> @if($banner->photo)
      <img src="{{$banner->photo}}" class="img-fluid zoom" style="max-width:80px" alt="{{$banner->photo}}">
      @else
      <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100%" alt="avatar.png">
      @endif
    </td>
    <td> @if($banner->status=='active')
      <span class="badge badge-success">{{$banner->status}}</span>
      @else
      <span class="badge badge-warning">{{$banner->status}}</span>
      @endif
    </td>
    <td>
      <x-Admin.ButtonAction :id="$banner->id" show="banner.show" edit="banner.edit" delete="banner.destroy" />
    </td>
  </tr>
  @endforeach
</x-Admin.Table>
<!-- End Page Content -->
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/sweetalert2.min.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('admin/js/main.js') }}"></script>
@endpush