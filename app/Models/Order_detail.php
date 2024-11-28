<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    public $table = 'Order_detail';
    public $fillable = ['order_id', 'product_id', 'quantity', 'price'];
}
