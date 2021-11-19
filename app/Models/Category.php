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
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    public static function getBySlug($slug)
    {
        return Category::where('slug', $slug)->first();
    }

    public static function getParentCategories()
    {
        return Category::whereNull('parent_id')->get();
    }

    public static function getListByParent()
    {
        return Category::with('children')->whereNull('parent_id')->get();
    }

    public static function getChildrenIds($parent_id)
    {
        return Category::where('parent_id', $parent_id)->pluck('id');
    }

    public static function getCountCategory()
    {
        $data = Category::get()->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
}
