<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Helpers;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['title', 'description', 'quantity', 'status', 'slug', 'images', 'price', 'sold', 'discount', 'category_id'];
    protected $appends = ['origin_price', 'price_after_discount'];

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public static function getBySlug($slug)
    {
        return Product::where('slug', $slug)->first();
    }

    public function getOriginPriceAttribute()
    {
        return Helpers::formatCurrency($this->price);
    }

    public function getPriceAfterDiscountAttribute()
    {
        $discount_price = $this->price * ($this->discount / 100);
        $real_price = $this->price - $discount_price;
        return Helpers::formatCurrency($real_price);
    }

    public static function getCountActiveProduct()
    {
        $data = Product::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
}
