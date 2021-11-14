<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['title', 'description', 'quantity', 'status', 'slug', 'images', 'price', 'sold', 'discount', 'category_id'];

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public static function getBySlug($slug)
    {
        return Product::where('slug', $slug)->first();
    }
}
