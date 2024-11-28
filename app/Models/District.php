<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    // use HasFactory;
    public $timestamps = false;
    protected $table = 'District';
    protected $fillable = ['district_id', 'province_id', 'name'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function wards()
    {
        return $this->hasMany(Wards::class);
    }
}
