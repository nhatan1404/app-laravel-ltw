<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsCategory extends Model
{
    use HasFactory;
    protected $table = 'posts_categories';
    protected $fillable = ['title', 'slug', 'parent_id'];
}
