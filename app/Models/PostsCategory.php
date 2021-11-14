<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsCategory extends Model
{
    use HasFactory;
    protected $table = 'posts_categories';
    protected $fillable = ['title', 'description', 'slug', 'parent_id'];

    public function posts()
    {
        return $this->hasMany('App\Models\Posts', 'category_id', 'id')->where('status', 'active');
    }

    public function parent()
    {
        return $this->hasMany('App\Models\PostsCategory', 'parent_id')->where('status', 'active');
    }

    public function children(){
        return $this->hasMany('App\Models\PostsCategory','parent_id','id');
    }

    public static function getParentCategories()
    {
        return PostsCategory::whereNull('parent_id')->orderBy('title', 'ASC')->get();
    }

    public static function getListByParent()
    {
        return PostsCategory::with('children')->whereNull('parent_id')->get();
    }
}
