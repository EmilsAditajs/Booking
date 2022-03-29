<?php

namespace App\Models;

class Review
{
    private int $id;
    private string $apartmentId;
    private string $userId;
    private string $userName;
    private string $review;

    public function __construct(int $id, string $apartmentId, string $userId, string $userName, string $review)
    {
        $this->id = $id;
        $this->apartmentId = $apartmentId;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->review = $review;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getApartmentId(): string
    {
        return $this->apartmentId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getReview(): string
    {
        return $this->review;
    }

}