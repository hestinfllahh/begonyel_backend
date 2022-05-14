<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'description', 'quantity', 'table_id', 'order_id'];
    public function product()
    {
        return $this->belongsto(Product::class, 'product_id');
    }
    public function table()
    {
        return $this->belongsto(Table::class, 'table_id');
    }
    public function order()
    {
        return $this->belongsto(Order::class, 'order_id');
    }
}
