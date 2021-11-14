<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Posts;
use App\Models\PostsCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('shop.home');
    }

    public function about()
    {
        return view('shop.about.index');
    }

    public function contact()
    {
        return view('shop.contact.index');
    }

    public function productList()
    {
        $products = Product::all();
        return view('shop.product.list', compact('products'));
    }

    public function productDetail($slug)
    {
        $product = Product::findorFail($slug);
        return view('shop.product.detail', compact('product'));
    }

    public function postSList()
    {
        $posts = Posts::all();
        return view('shop.posts.list', compact('posts'));
    }

    public function postsDetail($slug)
    {
        $post = Posts::getBySlug($slug);
        return view('shop.posts.detail', compact('post'));
    }
}
