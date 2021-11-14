<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['title', 'description', 'slug', 'parent_id'];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'id')->where('status', 'active');
    }

    public function parent()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->where('status', 'active');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    public static function getListByParent()
    {
        return Category::with('children')->whereNull('parent_id')->get();
    }
}
