<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsCategory extends Model
{
    use HasFactory;
    protected $table = 'posts_categories';
    protected $fillable = ['title', 'description', 'slug', 'parent_id'];
    protected $appends = ['total_posts'];

    public function posts()
    {
        return $this->hasMany('App\Models\Posts', 'category_id', 'id')->where('status', 'active');
    }

    public function parent()
    {
        return $this->hasMany('App\Models\PostsCategory', 'parent_id')->where('status', 'active');
    }

    public function children()
    {
        return $this->hasMany('App\Models\PostsCategory', 'parent_id', 'id');
    }

    public static function getBySlug($slug)
    {
        return PostsCategory::where('slug', $slug)->first();
    }

    public static function getParentCategories()
    {
        return PostsCategory::whereNull('parent_id')->orderBy('title', 'ASC')->get();
    }

    public static function getListByParent()
    {
        return PostsCategory::with('children')->whereNull('parent_id')->get();
    }

    public function getTotalPostsAttribute()
    {
        return $this->hasMany('App\Models\Posts', 'category_id', 'id')->where('status', 'active')->count();
    }

    public static function getCountPostCategory()
    {
        return PostsCategory::get()->count();
    }
}
