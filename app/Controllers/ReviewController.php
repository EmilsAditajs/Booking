<?php

namespace App\Controllers;

use App\Redirect;
use App\View;
use App\Exceptions\ReviewValidationException;
use App\Validations\Errors;
use App\Database;
use App\Models\Review;

class ReviewController
{
    public function show(array $vars): View
    {

        $reviewQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('reviews')
            ->where('apartment_id = ?')
            ->setParameter(0, (int) $vars['id'])
            ->executeQuery()
            ->fetchAllAssociative();

        $reviews = [];

        foreach($reviewQuery as $review) {
            $reviews[] = new Review(
            $review['id'],
            $review['apartment_id'],
            $review['user_id'],
            $review['user_name'],
            $review['review']
        );
        }

        return new View('/review', [
            'reviews' => $reviews,
            'userName' => $_SESSION["userSession"]['name'] ?? null,
            'userSurname' => $_SESSION["userSession"]['surname'] ?? null,
            'userId' => $_SESSION["userSession"]['id'] ?? null,
            'errors' => Errors::getAll(),
            'inputs' => $_SESSION['inputs'] ?? []
        ]);

    }

    public function reviewSubmit(array $vars): Redirect
    {
        Database::connection()
            ->insert('reviews', [
                'apartment_id' => $vars['id'],
                'user_id' => $_SESSION["userSession"]['id'],
                'user_name' => $_SESSION["userSession"]['name'],
                'review' => $_POST['review'],
            ]);

        return new Redirect('/Booking2.0/index.php/');
    }
}