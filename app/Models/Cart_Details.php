<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_Details extends Model
{
    public $timestamps = false;
    protected $table = 'Cart_Details';
    protected $fillable = ['id', 'id_cart', 'id_product', 'quantity', 'price'];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_cart');
    }
}
