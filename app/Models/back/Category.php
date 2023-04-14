<?php

namespace App\Models\back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getCreatedAtAttribute($value)
    {
        return date('d-M-Y', strtotime($value));
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::lower($value);
    }
}
