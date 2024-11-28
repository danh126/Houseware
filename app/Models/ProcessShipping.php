<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessShipping extends Model
{
    // use HasFactory;
    public $table = 'Process_shipping';
    public $fillable = ['id', 'name'];
}
