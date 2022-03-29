<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ReservationTest extends TestCase
{
    public function testGetApartmentId(): void
    {
        $reservation = new \App\Models\Reservation(1, 2, 'StartDateTest','EndDateTest');
        $this->assertSame(1, $reservation->getApartmentId());
    }

    public function testGetUserId(): void
    {
        $reservation = new \App\Models\Reservation(1, 2, 'StartDateTest','EndDateTest');
        $this->assertSame(2, $reservation->getUserId());
    }

    public function testGetStartDate(): void
    {
        $reservation = new \App\Models\Reservation(1, 2, 'StartDateTest','EndDateTest');
        $this->assertSame('StartDateTest', $reservation->getStartDate());
    }

    public function testGetSEndDate(): void
    {
        $reservation = new \App\Models\Reservation(1, 2, 'StartDateTest','EndDateTest');
        $this->assertSame('EndDateTest', $reservation->getEndDate());
    }
}