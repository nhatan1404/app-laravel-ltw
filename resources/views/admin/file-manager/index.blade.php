@extends('admin.layouts.app')
@section('title', 'Quản Lý Tập Tin')

@section('content')
    <div class="container-fluid">
        <iframe src="/laravel-filemanager?type=file"
            style="width: 100%; height: 700px; overflow: hidden; border: none;"></iframe>
    </div>
@endsection
