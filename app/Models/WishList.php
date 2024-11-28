<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    // use HasFactory;
    public $table = 'Wishlist';
    public $fillable = ['id', 'user_id', 'product_id', 'price'];
}
