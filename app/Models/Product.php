<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'availability',
        'image',
        'category_id',
        'updated_by',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class); // Assuming a Product belongs to a Category
    }

    /**
     * Get the user that updated the product.
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by'); // Assuming a Product is updated by a User
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

}
