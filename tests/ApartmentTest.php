<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ApartmentTest extends TestCase
{
    public function testGetId(): void
    {
        $apartment = new \App\Models\Apartment(1, '2', 'TitleTest', 'DescriptionTest', 'AddressTest', 'CreatedAtTest', 10.0);
        $this->assertSame(1, $apartment->getId());
    }

    public function testGetUserId(): void
    {
        $apartment = new \App\Models\Apartment(1, '2', 'TitleTest', 'DescriptionTest', 'AddressTest', 'CreatedAtTest', 10.0);
        $this->assertSame('2', $apartment->getUserId());
    }

    public function testGetTitle(): void
    {
        $apartment = new \App\Models\Apartment(1, '2', 'TitleTest', 'DescriptionTest', 'AddressTest', 'CreatedAtTest', 10.0);
        $this->assertSame('TitleTest', $apartment->getTitle());
    }

    public function testGetDescription(): void
    {
        $apartment = new \App\Models\Apartment(1, '2', 'TitleTest', 'DescriptionTest', 'AddressTest', 'CreatedAtTest', 10.0);
        $this->assertSame('DescriptionTest', $apartment->getDescription());
    }

    public function testGetCreatedAt(): void
    {
        $apartment = new \App\Models\Apartment(1, '2', 'TitleTest', 'DescriptionTest', 'AddressTest', 'CreatedAtTest', 10.0);
        $this->assertSame('CreatedAtTest', $apartment->getCreatedAt());
    }

    public function testGetPrice(): void
    {
        $apartment = new \App\Models\Apartment(1, '2', 'TitleTest', 'DescriptionTest', 'AddressTest', 'CreatedAtTest', 10.0);
        $this->assertSame(10, $apartment->getPrice());
    }
}