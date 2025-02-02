<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CartItems extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'user_id', 
        'product_id', 
        'quantity',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function Product()
    {
        return $this->hasOne(Product::class, 'id');
    }

}
