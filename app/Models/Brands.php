<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brands extends Model
{
    public $timestamps = false;
    protected $table = 'Brands';
    protected $fillable = ['brandName', 'description', 'brandLogo'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
