<?php

namespace App\Services\Apartment\Show;

use App\Database;
use App\Models\Apartment;

class ShowApartmentService
{
    public function execute(ShowApartmentRequest $request): ShowArticleResponse
    {
        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, (int) $request->getId())
            ->executeQuery()
            ->fetchAssociative();

        $apartment = new Apartment(
            $apartmentQuery['id'],
            $apartmentQuery['user_id'],
            $apartmentQuery['title'],
            $apartmentQuery['description'],
            $apartmentQuery['address'],
            $apartmentQuery['created_at'],
            $apartmentQuery['price']
        );

        return new ShowArticleResponse();
    }
}