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
        $parent_categories = PostsCategory::getParentCategories();
        return view('admin.posts-category.create', compact('parent_categories'));
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
            'title.max' => 'Tiêu đề không được lớn hơn 100 kí tự',
            'description.string' => 'Mô tả phải là chuỗi kí tự',
            'description.max' => 'Mô tả không được lớn hơn 200 kí tự',
            'parent_id.exists' => 'Danh mục cha không tồn tại',
        ];

        $this->validate($request, [
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:200',
            'parent_id' => 'nullable|exists:posts_categories,id'
        ], $messages);

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
        $posts_category = PostsCategory::find($id);

        if ($posts_category == null) {
            return abort(404, 'Danh mục bài viết không tồn tại');
        }

        return view('admin.posts-category.detail', compact('posts_category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts_category = PostsCategory::find($id);

        if ($posts_category == null) {
            return abort(404, 'Danh mục bài viết không tồn tại');
        }

        $parent_categories = PostsCategory::getParentCategories();
        return view('admin.posts-category.edit', compact('posts_category', 'parent_categories'));
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
        $posts_category = PostsCategory::find($id);

        if ($posts_category == null) {
            return abort(404, 'Danh mục bài viết không tồn tại');
        }

        $messages = [
            'title.required' => 'Tiêu đề không được bỏ trống',
            'title.string' => 'Tiêu đề phải là chuỗi kí tự',
            'title.max' => 'Tiêu đề không được lớn hơn 100 kí tự',
            'description.string' => 'Mô tả phải là chuỗi kí tự',
            'description.max' => 'Mô tả không được lớn hơn 200 kí tự',
            'parent_id.exists' => 'Danh mục cha không tồn tại',
        ];

        $this->validate($request, [
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:200',
            'parent_id' => 'nullable|exists:posts_categories,id'
        ], $messages);

        $data = $request->all();
        $status = $posts_category->fill($data)->save();

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
        $posts_category = PostsCategory::find($id);

        if ($posts_category == null) {
            return abort(404, 'Danh mục bài viết không tồn tại');
        }

        try {
            $status = $posts_category->delete();

            if ($status) {
                request()->session()->flash('success', 'Đã xoá danh mục bài viết thành công');
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

        return redirect()->route('posts-category.index');
    }
}
