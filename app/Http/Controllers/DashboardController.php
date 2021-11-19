<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Posts;
use App\Models\Order;
use App\Models\Category;
use App\Models\User;
use App\Models\Voucher;
use App\Models\PostsCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count_product = Product::getCountActiveProduct();
        $count_category = Category::getCountCategory();
        $count_order = Order::getCountActiveOrder();
        $count_posts = Posts::getCountActivePosts();
        $count_user = User::getCountActiveUser();
        $count_voucher = Voucher::getCountActiveVoucher();
        $count_post_category = PostsCategory::getCountPostCategory();
        return view('admin.home', compact(
            'count_product',
            'count_category',
            'count_order',
            'count_posts',
            'count_user',
            'count_voucher',
            'count_post_category'
        ));
    }

    public function fileManager()
    {
        return view('admin.file-manager.index');
    }
}
