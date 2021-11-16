<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['user_id', 'order_id', 'total'];
    protected $appends = ['count'];

    public function items()
    {
        return $this->hasMany('App\Models\CartItem', 'cart_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function getCountAttribute()
    {
        return $this->items->count();
    }
}
