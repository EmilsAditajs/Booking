<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    public function testGetEmail(): void
    {
        $login = new \App\Models\Login('EmailTest', 'PasswordTest');
        $this->assertSame('EmailTest', $login->getEmail());
    }

    public function testGetPassword(): void
    {
        $login = new \App\Models\Login('EmailTest', 'PasswordTest');
        $this->assertSame('PasswordTest', $login->getPassword());
    }
}