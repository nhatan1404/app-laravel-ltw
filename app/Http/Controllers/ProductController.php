<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(15);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::getListByParent();
        return view('admin.product.create', compact('categories'));
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
            'description' => 'string|required',
            'quantity' => 'integer|required',
            'status' => 'required:|in:active,inactive',
            'images' => 'string|required',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data = $request->all();
        $slug = Str::Slug($request->title);
        $count = Product::where('slug', $slug)->count();

        if ($count > 0) {
            $slug += '-' . $count;
        }

        $data['slug'] = $slug;
        $status = Product::create($data);
        if ($status) {
            request()->session()->flash('success', 'Tạo sản phẩm thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::getListByParent();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->validate($request, [
            'title' => 'string|required',
            'description' => 'string|required',
            'quantity' => 'integer|required',
            'status' => 'required:|in:active,inactive',
            'images' => 'string|required',
            'price' => 'required|numeric',
            'sold' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);

        $data = $request->all();
        $status = $product->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Cập nhật sản phẩm thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $status = $product->delete();

        if ($status) {
            request()->session()->flash('success', 'Xoá sản phẩm thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }
}
