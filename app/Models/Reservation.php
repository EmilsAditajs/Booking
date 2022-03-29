<?php

namespace App\Models;

class Reservation
{
    private int $apartmentId;
    private int $userId;
    private string $startDate;
    private string $endDate;

    public function __construct(int $apartmentId, int $userId, string $startDate, string $endDate)
    {
        $this->apartmentId = $apartmentId;
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function getApartmentId():int
    {
        return $this->apartmentId;
    }
    public function getUserId():int
    {
        return $this->userId;
    }
    public function getStartDate():string
    {
        return $this->startDate;
    }
    public function getEndDate():string
    {
        return $this->endDate;
    }
}