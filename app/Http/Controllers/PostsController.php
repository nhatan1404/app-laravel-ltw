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
        $this->validate(
            $request,
            [
                'title' => 'string|required',
                'description' => 'string|required',
                'content' => 'string|required',
                'thumbnail' => 'string|required',
                'status' => 'required|in:active,inactive',
                'category_id' => 'required|exists:posts_categories,id',
                'user_id' => 'required|exists:users,id'
            ]
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Posts::findOrFail($id);
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
        $posts = Posts::findOrFail($id);
        $this->validate(
            $request,
            [
                'title' => 'string|required',
                'description' => 'string|required',
                'content' => 'string|required',
                'thumbnail' => 'string|required',
                'status' => 'required|in:active,inactive',
                'category_id' => 'required|exists:posts_categories,id',
                'user_id' => 'required|exists:users,id'
            ]
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
        $posts = Posts::findOrFail($id);
        //$status = $posts->delete();
        $status = true;

        if ($status) {
            request()->session()->flash('success', 'Đã xoá bài viết thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }
}
