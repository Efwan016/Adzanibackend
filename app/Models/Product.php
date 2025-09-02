<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    //



    use SoftDeletes;

    protected $fillable = ['name', 'thumbnail', 'about', 'price', 'categoy_id', 'is_popular'];

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function merchants()
    {
        return $this->belongsToMany(Merchant::class, 'merchant_product')
                    ->withPivot('stock')
                    ->withTimestamps();
    }

    public function warehouse()
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_products')
                   ->withPivot('stock')
                   ->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany(transactionProduct::class);
    }

    public function getWareHouseProductStock()
    {
        return $this->warehouse()->sum('stock');
    }

    public function getMerchantProductStock()
    {
        return $this->merchants()->sum('stock');
    }

    public function getThumbnailAttribute($value)
    {
        if (!$value) {
            return null; // NO image available
        }

        return url(Storage::url($value)); // domain.com/storage/product/nama-photo.png
    }


}
