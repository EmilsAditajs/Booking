<?php

namespace App\Validations;

use App\Exceptions\ApartmentValidationException;

class ApartmentValidator
{
    private array $data;
    private array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function passes():void
    {
        foreach ($this->data as $key => $value) {
            if (empty($value)) {
                $keyToUpper = ucfirst($key);
                $this->errors[$key][] = "{$keyToUpper} field is required";
            }
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->data['name'])) {
            $this->errors["invalidName"][] = "Invalid name";
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->data['surname'])) {
            $this->errors["invalidSurname"][] = "Invalid surname";
        }
        if ($this->data['password'] !== $this->data['passwordRepeat']) {
            $this->errors["passwordsDontMatch"][] = "Passwords do not match";
        }

        if (count($this->errors) > 0) {
            throw new ApartmentValidationException();
        }
    }

    public function getErrors():array
    {
        return $this->errors;
    }
}