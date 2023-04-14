<?php

namespace App\Models\back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Brand extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
       return $this->belongsToMany(Subcategory::class, 'multibrands');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::lower($value);
    }

    public function getCreateAtAttribute($date)
    {
        return date('d-M-Y',strtotime($date));
    }
}
