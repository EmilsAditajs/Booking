<?php

namespace App\Services\Apartment\Store;

use App\Database;

class StoreApartmentService
{
    public function execute(StoreApartmentRequest $request)
    {
        Database::connection()
            ->insert('apartments', [
                'title' => $request->getTitle(),
                'description' => $request->getDescription(),
                'address' => $request->getAddress(),
                'price' => $request->getPrice(),
                'user_id' => $request->getUserId()
            ]);
    }
}