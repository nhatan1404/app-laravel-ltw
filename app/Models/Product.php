<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return number_format($this->price, 0, ',', '.');
    }

    public function getPriceAfterDiscountAttribute()
    {
        $discount_price = $this->price * ($this->discount / 100);
        $real_price = $this->price - $discount_price;
        return number_format($real_price, 0, ',', '.');
    }
}
