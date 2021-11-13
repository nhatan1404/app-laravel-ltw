<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['title', 'descripton', 'quantity', 'status', 'slug', 'images', 'price', 'sold', 'discount', 'category_id'];
}
