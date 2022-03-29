<?php

namespace App\Controllers;

use App\Redirect;
use App\Database;
use App\Validations\ReservationValidator;
use App\Exceptions\ReservationFormException;
use App\Validations\Errors;

class ReservationController
{
    public function reserve(array $vars): Redirect
    {
        try {
            $validator = (new ReservationValidator([$_POST, $vars], [
                'startDate' => 'required',
                'endDate' => 'required',
            ]));
            $validator->passes();
        } catch (ReservationFormException $exception) {

            $_SESSION['errors'] = $validator->getErrors();
            $_SESSION['inputs'] = $_POST;

            return new Redirect('/Booking2.0/index.php');
        }

        Database::connection()
            ->insert('reservations', [
                'apartment_id' => $vars['id'],
                'user_id' => $_SESSION["userSession"]['id'],
                'start_date' => $_POST['startDate'],
                'end_date' => $_POST['endDate']
            ]);

        return new Redirect('/Booking2.0/index.php/');
    }
}