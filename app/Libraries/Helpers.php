<?php

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
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

  public static function getRandomProduct()
  {
    return Product::all()->random(4);
  }

  public static function getCartCount()
  {
    $cart = Cart::where('user_id', Auth::id())->where('status', 'active')->first();
    if (!$cart) {
      return 0;
    }
    return $cart->count;
  }

  public static function generateOrderNumber($last_id)
  {
    return '#' . str_pad($last_id + 1, 10, "0", STR_PAD_LEFT);
  }

  public static function getAllProvince()
  {
    return Province::get();
  }

  public static function getDistricts($id)
  {
    $province = Province::find($id);
    if ($province) {
      return $province->districts;
    }
    return [];
  }

  public static function getWards($id)
  {
    $district = District::find($id);
    if ($district) {
      return $district->wards;
    }
    return [];
  }
}
