<?php

namespace App\Http\Controllers;

use App\Models\PostsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts_categories = PostsCategory::orderBy('id', 'DESC')->paginate(15);
        return view('admin.posts-category.index', compact('posts_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required',
            'parent_id' => 'exists:posts_categories,id'
        ]);

        $data = $request->all();
        $slug = Str::slug($data['title']);

        $count = PostsCategory::where('slug', $slug)->count();

        if ($count > 0) {
            $slug += '-' + $count;
        }

        $data['slug'] = $slug;
        $status = PostsCategory::create($data);
        if ($status) {
            request()->session()->flash('success', 'Tạo danh mục bài viết thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('posts-category.index');
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
        $posts_categories = PostsCategory::findOrFail($id);
        return view('admin.posts-category.edit', compact('posts_categories'));
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
        $posts_categories = PostsCategory::findOrFail($id);
        $this->validate($request, [
            'title' => 'string|required',
            'parent_id' => 'exists:posts_categories,id'
        ]);

        $data = $request->all();

        $status = $posts_categories->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Cập nhật danh mục bài viết thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('posts-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts_categories = PostsCategory::findOrFail($id);
        $status = $posts_categories->delete();
        if ($status) {
            request()->session()->flash('success', 'Đã xoá danh mục bài viết thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }
}
