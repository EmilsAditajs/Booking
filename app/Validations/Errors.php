<?php

namespace App\Validations;

class Errors
{
    public static function getAll(): array
    {
        return $_SESSION['errors'] ?? [];
    }
}