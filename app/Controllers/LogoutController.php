<?php

namespace App\Controllers;

use App\Redirect;

class LogoutController
{
    public function logout(): Redirect
    {
        unset($_SESSION['userSession']);

        return new Redirect("/Booking2.0/index.php/");
    }
}