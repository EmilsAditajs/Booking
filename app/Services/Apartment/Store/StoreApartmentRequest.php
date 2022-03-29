<?php

namespace App\Services\Apartment\Store;

class StoreApartmentRequest
{

    private string $title;
    private string $description;
    private string $address;
    private float $price;
    private int $userId;

    public function __construct(string $title, string $description, string $address, float $price, int $userId)
    {

        $this->title = $title;
        $this->description = $description;
        $this->address = $address;
        $this->price = $price;
        $this->userId = $userId;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}