<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ReviewTest extends TestCase
{
    public function testGetId(): void
    {
        $review = new \App\Models\Review(1, '2', '3','UserNameTest', 'ReviewTest');
        $this->assertSame(1, $review->getId());
    }

    public function testGetApartmentId(): void
    {
        $review = new \App\Models\Review(1, '2', '3','UserNameTest', 'ReviewTest');
        $this->assertSame('2', $review->getApartmentId());
    }

    public function testGetUserId(): void
    {
        $review = new \App\Models\Review(1, '2', '3','UserNameTest', 'ReviewTest');
        $this->assertSame('3', $review->getUserId());
    }

    public function testGetUserName(): void
    {
        $review = new \App\Models\Review(1, '2', '3','UserNameTest', 'ReviewTest');
        $this->assertSame('UserNameTest', $review->getUserName());
    }

    public function testGetReview(): void
    {
        $review = new \App\Models\Review(1, '2', '3','UserNameTest', 'ReviewTest');
        $this->assertSame('ReviewTest', $review->getReview());
    }
}