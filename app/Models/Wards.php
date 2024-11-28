<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false;
    protected $table = 'Wards';
    protected $fillable = ['wards_id', 'district_id', 'name'];

    public function disctrict()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
