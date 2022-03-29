<?php

namespace App\Controllers;

use App\Database;
use App\Models\Apartment;
use App\View;
use App\Validations\Errors;

class HomeController
{
    public function home():View
    {
        $apartmentsQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->orderBy('created_at', 'desc')
            ->fetchAllAssociative();

        $apartments = [];
        foreach ($apartmentsQuery as $apartment) {
            $apartments[] = new Apartment(
                (int)$apartment['id'],
                (int)$apartment['user_id'],
                $apartment['title'],
                $apartment['description'],
                $apartment['address'],
                $apartment['created_at'],
                $apartment['price'],
            );
        }

        return new View("home", [
            'errors' => Errors::getAll(),
            "apartments" => $apartments,
            'userName' => $_SESSION["userSession"]['name'] ?? null,
            'userSurname' => $_SESSION["userSession"]['surname'] ?? null,
            'userId' => $_SESSION["userSession"]['id'] ?? null
        ]);
    }


}