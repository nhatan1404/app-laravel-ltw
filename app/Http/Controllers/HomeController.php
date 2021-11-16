<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Posts;
use App\Models\PostsCategory;
use Auth;

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
    public function index(Request $request)
    {
        $products = Product::orderBy('created_at', 'DESC')->where('status', 'active')->paginate(8);

        if ($request->ajax()) {
            $html = view('shop.product.list', compact('products'))->render();
            return response()->json($html);
        }
        return view('shop.home', compact('products'));
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
        $products = Product::orderBy('created_at', 'DESC')->where('status', 'active')->paginate(8);
        return view('shop.product.index', compact('products'));
    }

    public function productDetail($slug)
    {
        $product = Product::getBySlug($slug);
        $related_products = Category::find($product->category_id)->products->take(4);
        return view('shop.product.detail', compact('product', 'related_products'));
    }

    public function productByCategory($slug)
    {
        $category = Category::getBySlug($slug);
        $products = $category->products()->paginate(8);
        if ($category->parent == null) {
            $children_id = Category::getChildrenIds($category->id);
            $products = Product::whereIn('category_id', $children_id)->paginate(8);
        }
        return view('shop.product.index', compact('products', 'category'));
    }

    public function postsList()
    {
        $posts = Posts::orderBy('created_at', 'DESC')->where('status', 'active')->paginate(5);
        $recent_posts = Posts::all()->random(3);
        $categories = PostsCategory::getParentCategories();
        return view('shop.posts.list', compact('posts', 'recent_posts', 'categories'));
    }

    public function postsDetail($slug)
    {
        $post = Posts::getBySlug($slug);
        $recent_posts = PostsCategory::find($post->category_id)->posts->take(3);
        $categories =  PostsCategory::getParentCategories();
        return view('shop.posts.detail', compact('post', 'recent_posts', 'categories'));
    }

    public function postsByCategory($slug)
    {
        $category = PostsCategory::getBySlug($slug);
        $posts = $category->posts()->paginate(5);
        $recent_posts = Posts::all()->random(3);
        $categories = PostsCategory::getParentCategories();
        return view('shop.posts.list', compact('posts', 'recent_posts', 'categories'));
    }

    public function login()
    {
        return view('shop.user.login');
    }

    public function register()
    {
        return view('shop.user.register');
    }

    public function profile($id)
    {
        $user = Auth::user();
        return view('shop.user.profile', compact('user'));
    }

    public function cart()
    {
        return view('shop.user.cart');
    }
    public function checkout()
    {
        return view('shop.user.checkout');
    }
}
