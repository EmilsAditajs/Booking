<?php

namespace App\Validations;

use App\Exceptions\ReservationFormException;
use App\Database;

class ReservationValidator
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

        if(!$this->checkReservations()){
            $this->errors["notAvailable"][] = "Dates are not available";
        }

        if (count($this->errors) > 0) {
            throw new ReservationFormException();
        }
    }

    public function checkReservations(): bool
    {
        $reservationInfo = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('reservations')
            ->where("apartment_id = ?")
            ->setParameter(0, $this->data[1]["id"])
            ->fetchAllAssociative();

        if(count($reservationInfo) == 0) {
            return true;
        }
        $s = 0;
        foreach ($reservationInfo as $each) {
            if ($_POST['startDate'] > $each['end_date'] || $_POST['endDate'] < $each['start_date']) {
                $s++;
            }
        }
        if (count($reservationInfo) == $s) {
            return true;
        }
        return false;
    }

    public function getErrors():array
    {
        return $this->errors;
    }
}
