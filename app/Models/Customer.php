<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $table = 'Customer';
    public $fillable = ['customer_id', 'fullname', 'email', 'phone', 'address'];
}
