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
    return number_format($currency, 0, ',', '.') . 'đ';
  }

  public static function getListMenuCategory()
  {
    return Category::getParentCategories();
  }

  public static function getRandomProduct()
  {
    if (Product::count() > 4) {
      return Product::all()->random(4);
    }
    return Product::all();
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

  public static function getStatusOrder($status)
  {
    switch ($status) {
      case 'new':
        return 'Đang chờ xác nhận';
      case 'accepted':
        return 'Chấp nhận';
      case 'delivering':
        return 'Đang vận chuyển';
      case 'cancel':
        return 'Đã huỷ';
      case 'done':
        return 'Hoàn thành';
      default:
        return '';
    }
  }

  public function displayStatusOrder(string $status): string
  {
    switch ($status) {
      case 'new':
        return '<span class="badge badge-secondary">Mới</span>';
      case 'accepted':
        return '<span class="badge badge-primary">Đã xác nhận</span>';
      case 'delivering':
        return '<span class="badge badge-info">Đang vận chuyển</span>';
      case 'cancel':
        return '<span class="badge badge-danger">Đã huỷ</span>';
      default:
        return '<span class="badge badge-success">Hoàn thành</span>';
    }
  }

  public function displayStatusProgress(string $status, int $position): string
  {
    $dataStatus = ['new', 'accepted', 'delivering', 'cancel', 'done'];
    if ($status == 'cancel') return 'step-cancel';
    return array_search($status, $dataStatus) >= $position ? 'active' : '';
  }

  public static function getPaginateList()
  {
    return [4, 8, 12, 16, 20, 24, 28];
  }

  public static function getSortList()
  {
    return [
      ['new', 'Mới nhất'],
      ['old', 'Cũ nhất'],
      ['sold', 'Bán chạy'],
      ['lowPrice', 'Giá từ thấp đến cao'],
      ['highPrice', 'Giá từ cao đến thấp']
    ];
  }

  public static function getDiscountMoney($total)
  {
    $discount_money = 0;
    if (session('coupon')) {
      $coupon = session('coupon');
      if ($coupon['type'] == 'fixed') {
        $discount_money = $coupon['value'];
      } else {
        $discount_money = ($total * ($coupon['value'] / 100));
      }
    }
    return $discount_money;
  }
}
