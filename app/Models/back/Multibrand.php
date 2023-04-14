<?php

namespace App\Models\back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multibrand extends Model
{
    use HasFactory;
    protected $fillable = ['brand_id','subcategory_id'];

}
