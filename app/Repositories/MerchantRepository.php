<?php

namespace App\Repositories;

use App\Models\Merchant;
use App\Models\Product;

class MerchantRepository
{

    public function getAll(array $fields)
    {
        return Merchant::select($fields)->with(['keepers', 'Product.category'])->lates()->paginate(10);
    }

    public function getById(int $id, array $fields)
    {
        return Merchant::select($fields)->with(['keepers', 'Product.category'])->findOrFail($id);
    }

    public function creat(array $data)
    {
        return Merchant::create($data);
    }

    public function update(int $id, array $data)
    {
        $merchant = Merchant::findOrFail($id);
        $merchant->update($data);
        return $merchant;
    }

    public function delete(int $id)
    {
        $merchant = Merchant::findOrFail($id);
        $merchant->delete();
    }

    public function getByKeedperId(int $keeperId, array $fields)
    {
        return Merchant::select($fields)->where('keeper_id', $keeperId)->with(['keepers', 'Product.category'])->firstOrFail();
    }
}