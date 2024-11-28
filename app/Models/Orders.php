<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    // use HasFactory;
    public $table = 'Orders';
    public $fillable = ['order_id', 'customer_id', 'user_id', 'note', 'order_discount', 'total_amount', 'payment', 'status'];
}
