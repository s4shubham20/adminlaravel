<?php

namespace App\Models\back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsToMany(Brand::class, 'multibrands');
        //return $this->belongsToMany(Brand::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::lower($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-M-Y', strtotime($value));
    }
}
