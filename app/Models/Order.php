<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "Orders";
    protected $fillable = ['invoice', 'customer_name', 'total', 'status_order', 'table_id']; 

    public function detailorder(){
        return $this -> hasMany(DetailOrder::class, 'order_id');
    }
    public function table()
    {
        return $this->belongsto(Table::class, 'table_id');
    }
}
