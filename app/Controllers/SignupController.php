<?php

namespace App\Controllers;

use App\View;
use App\Database;
use App\Redirect;
use App\Validations\Errors;
use App\Validations\SignupValidator;
use App\Exceptions\SignupValidationException;

class SignupController
{
    public function signup():View
    {
        return new View('/signup', [
            'errors' => Errors::getAll(),
            'inputs' => $_SESSION['inputs'] ?? []
        ]);
    }

    public function signupSubmit():Redirect
    {
        try {
            $validator = (new SignupValidator($_POST));
            $validator->passes();
        } catch (SignupValidationException $exception) {
            $_SESSION['errors'] = $validator->getErrors();
            $_SESSION['inputs'] = $_POST;
            return new Redirect("/Booking2.0/index.php/signup");
        }

        $hashedPwd = password_hash($_POST["password"], PASSWORD_DEFAULT);

        Database::connection()
            ->insert('users', [
                'email' => $_POST['email'],
                'password' => $hashedPwd,
            ]);

        $createdUser = Database::connection()
            ->createQueryBuilder()
            ->select('id')
            ->from('users')
            ->where("email = ?")
            ->setParameter(0, $_POST['email'])
            ->fetchAllAssociative();

        Database::connection()
            ->insert('user_profiles', [
                'user_id' => $createdUser[0]['id'],
                'name' => $_POST['name'],
                'surname' => $_POST['surname'],
                'birthday' => $_POST['birthday']
            ]);

        return new Redirect("/Booking2.0/index.php/signup");
    }
}