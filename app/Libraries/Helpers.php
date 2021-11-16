<?php

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class Helpers
{

  public static function formatCurrency($currency)
  {
    return number_format($currency, 0, ',', '.');
  }

  public static function getListMenuCategory()
  {
    return Category::getParentCategories();
  }

  public static function getCartCount()
  {
    return Cart::where('user_id', Auth::id())->first()->count;
  }
}
