<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ['name', 'price'];
    
    public function photo()
    {
        return $this->hasMany(Photo::class, 'product_id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
}
