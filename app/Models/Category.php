<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'photo', 'tagline'];

    public function products()
    {
        return $this->hasMany(product::class);
    }

    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return null;
        }

        return url(Storage::url($value));
    }
}
