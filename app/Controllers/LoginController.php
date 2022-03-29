<?php

namespace App\Controllers;

use App\View;
use App\Validations\Errors;
use App\Redirect;
use App\Exceptions\LoginValidationException;
use App\Validations\LoginValidator;
use App\Database;

class LoginController
{
    public function login():View
    {
        return new View('/login', [
            'errors' => Errors::getAll(),
            'inputs' => $_SESSION['inputs'] ?? []
        ]);
    }

    public function loginSubmit(): Redirect
    {
        try {
            $validator = (new LoginValidator($_POST));
            $validator->passes();
        } catch (loginValidationException $exception) {
            $_SESSION['errors'] = $validator->getErrors();
            $_SESSION['inputs'] = $_POST;
            return new Redirect("/login");
        }


        $user = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->where("email = ?")
            ->setParameter(0, $_POST["email"])
            ->fetchAllAssociative();


        $userProfile = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('user_profiles')
            ->where("user_id = ?")
            ->setParameter(0, $user[0]['id'])
            ->fetchAllAssociative();

        $_SESSION["userSession"]['id'] = htmlentities($user[0]["id"]);
        $_SESSION["userSession"]['name'] = htmlentities($userProfile[0]["name"]);
        $_SESSION["userSession"]['surname'] = htmlentities($userProfile[0]["surname"]);

        return new Redirect("/Booking2.0/index.php/");
    }
}