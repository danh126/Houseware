<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // use HasFactory;
    protected $table = 'Cart';
    protected $primaryKey = 'id';
    public $incrementing = false; // Nếu 'id' không phải là AUTO_INCREMENT
    protected $keyType = 'string'; // Nếu 'id' là VARCHAR hoặc UUID

    protected $fillable = ['id', 'id_user', 'id_session'];

    public function CartDetails()
    {
        return $this->hasMany(Cart_Details::class, 'id');
    }
}
