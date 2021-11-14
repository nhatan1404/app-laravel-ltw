<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['title', 'description', 'content', 'slug', 'thumbnail', 'status', 'category_id', 'user_id'];

    public function category(){
        return $this->hasOne('App\Models\PostsCategory','id','category_id');
    }

    public function author(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public static function getList() {
        return Posts::with(['category','author'])->orderBy('id','DESC')->paginate(15);
    }
}
