<?php

namespace App\Models;

use App\FullTextSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use FullTextSearch;

    protected $searchable = ['productName'];

    public $timestamps = false;
    protected $table = 'Product';
    protected $fillable = ['id', 'brandId', 'categoryId', 'productName', 'description', 'imageUrl', 'quantity', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brandId');
    }
}
