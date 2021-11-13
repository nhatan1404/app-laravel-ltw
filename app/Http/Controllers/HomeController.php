<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('shop.product.list');
    }

    public function productDetail($slug)
    {
        return view('shop.product.detail');
    }

    public function postSList()
    {
        return view('shop.product.list');
    }

    public function postsDetail($slug)
    {
        return view('shop.product.detail');
    }
}
