<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\PostsCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::getList();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PostsCategory::getListByParent();
        $users = User::all();
        $current_user = Auth::id();
        return view('admin.posts.create', compact('categories', 'users', 'current_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'Tiêu đề không được bỏ trống',
            'title.string' => 'Tiêu đề phải là chuỗi kí tự',
            'title.max' => 'Tiêu đề không được lớn hơn 255 kí tự',
            'description.required' => 'Mô tả không được bỏ trống',
            'description.string' => 'Mô tả phải là chuỗi kí tự',
            'description.max' => 'Mô tả không được lớn hơn 500 kí tự',
            'content.required' => 'Nội dung không được bỏ trống',
            'content.string' => 'Nội dung phải là chuỗi kí tự',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'thumbnail.required' => 'Ảnh không được bỏ trống',
            'thumbnail.string' => 'Ảnh phải là chuỗi kí tự',
            'category_id.required' => 'Danh mục không được bỏ trống',
            'category_id.exists' => 'Danh mục không tồn tại',
            'user_id.required' => 'Tác giả không được bỏ trống',
            'user_id.exitsts' => 'Tác giả không tồn tại',
        ];

        $this->validate(
            $request,
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'content' => 'required|string',
                'thumbnail' => 'required|string',
                'status' => 'required|in:active,inactive',
                'category_id' => 'required|exists:posts_categories,id',
                'user_id' => 'required|exists:users,id'
            ],
            $messages
        );

        $data = $request->all();
        $slug = Str::slug($data['title']);
        $count = Posts::where('slug', $slug)->count();

        if ($count > 0) {
            $slug += '-' + $count;
        }

        $data['slug'] = $slug;
        $status = Posts::create($data);

        if ($status) {
            request()->session()->flash('success', 'Tạo bài viết thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Posts::find($id);

        if ($posts == null) {
            return abort(404, 'Bài viết không tồn tại');
        }

        return view('admin.posts.detail', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Posts::find($id);

        if ($posts == null) {
            return abort(404, 'Bài viết không tồn tại');
        }

        $categories = PostsCategory::all();
        $users = User::all();
        return view('admin.posts.edit', compact('posts', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $posts = Posts::find($id);

        if ($posts == null) {
            return abort(404, 'Bài viết không tồn tại');
        }

        $messages = [
            'title.required' => 'Tiêu đề không được bỏ trống',
            'title.string' => 'Tiêu đề phải là chuỗi kí tự',
            'title.max' => 'Tiêu đề không được lớn hơn 255 kí tự',
            'description.required' => 'Mô tả không được bỏ trống',
            'description.string' => 'Mô tả phải là chuỗi kí tự',
            'description.max' => 'Mô tả không được lớn hơn 500 kí tự',
            'content.required' => 'Nội dung không được bỏ trống',
            'content.string' => 'Nội dung phải là chuỗi kí tự',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'thumbnail.required' => 'Ảnh không được bỏ trống',
            'thumbnail.string' => 'Ảnh phải là chuỗi kí tự',
            'category_id.required' => 'Danh mục không được bỏ trống',
            'category_id.exists' => 'Danh mục không tồn tại',
            'user_id.required' => 'Tác giả không được bỏ trống',
            'user_id.exitsts' => 'Tác giả không tồn tại',
        ];
        $this->validate(
            $request,
            [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'content' => 'required|string',
                'thumbnail' => 'required|string',
                'status' => 'required|in:active,inactive',
                'category_id' => 'required|exists:posts_categories,id',
                'user_id' => 'required|exists:users,id'
            ],
            $messages
        );

        $data = $request->all();
        $status = $posts->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Cập nhật bài viết thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Posts::find($id);

        if ($posts == null) {
            return abort(404, 'Bài viết không tồn tại');
        }

        try {
            $status = $posts->delete();

            if ($status) {
                request()->session()->flash('success', 'Đã xoá bài viết thành công');
            } else {
                request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            if ((int)$ex->errorInfo[0] === 23000) {
                request()->session()->flash('error', 'Không thể xoá vì tồn tại ràng buộc khoá ngoại!');
            } else {
                request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
        }
        return redirect()->route('posts.index');
    }
}
