<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    public $timestamps = false;
    protected $table = 'ImageProduct';
    protected $fillable = ['id', 'productId', 'imageUrl'];
}
