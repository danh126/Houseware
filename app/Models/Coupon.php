<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    // use HasFactory;
    public $table = 'Coupon';
    public $fillable = ['code_coupon', 'coupon_apply'];
}
