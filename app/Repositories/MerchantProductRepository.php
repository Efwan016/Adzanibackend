<?php

namespace App\Repositories;

use App\Models\MerchantProduct;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use illuminate\Pagination\LengthAwarePaginator;
use illuminate\Validation\ValidationException;

class MerchantProductRepository
{

    public function create(array $data)
    {
        return MerchantProduct::create($data);
    }

    public function getByMerchantAndProduct(int $merchantId, int $productId)
    {
        return MerchantProduct::where('merchant_id', $merchantId)
            ->where('product_id', $productId)
            ->first();
    }

    public function updateStock(int $merchantId, int $productId, int $Stock)
    {
        $merchantProduct = $this->getByMerchantAndProduct($merchantId, $productId);
        if (!$merchantProduct) {
            throw ValidationException::withMessages(['message' => 'MerchantProduct not found']);
        }
        $merchantProduct->update(['stock' => $Stock]);
        return $merchantProduct;
    }

}