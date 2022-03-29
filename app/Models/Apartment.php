<?php

namespace App\Models;

class Apartment
{
    private int $id;
    private string $userId;
    private string $title;
    private string $description;
    private string $address;
    private string $createdAt;
    private int $price;

    public function __construct(int $id, string $userId, string $title, string $description, string $address, string $createdAt, float $price)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->description = $description;
        $this->address = $address;
        $this->createdAt = $createdAt;
        $this->price = $price;
    }
    public function getId():int
    {
        return $this->id;
    }
    public function getUserId():string
    {
        return $this->userId;
    }
    public function getTitle():string
    {
        return $this->title;
    }
    public function getDescription():string
    {
        return $this->description;
    }
    public function getAddress():string
    {
        return $this->address;
    }
    public function getCreatedAt():string
    {
        return $this->createdAt;
    }
    public function getPrice():int
    {
        return $this->price;
    }

}