<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Merchant extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['name', 'address', 'photo', 'phone', 'keeper_id'];

    public function keeper()
    {
        return $this->belongTo(User::class, 'keeper_id');
    }

    public function products()
    {
        return $this->belongToMany(Product::class, 'merchant_products')
                    ->withPivot('stock')
                    ->withPivot('warehouse_id')
                    ->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return null;
        }

        return url(Storage::url($value));
    }
}
