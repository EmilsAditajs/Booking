<?php

namespace App\Validations;

use App\Exceptions\SignupValidationException;
use App\Database;

class SignupValidator
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
        if ($this->checkIfUserExists()) {
            $this->errors["userExists"][] = "User already exists";
        }
        if (count($this->errors) > 0) {
            throw new SignupValidationException();
        }
    }

    public function checkIfUserExists(): bool
    {
        $userQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('users')
            ->where("email = ?")
            ->setParameter(0, $this->data['email'])
            ->fetchAllAssociative();
        if(count($userQuery) > 0) {
            return true;
        };
        return false;
    }

    public function getErrors():array
    {
        return $this->errors;
    }
}