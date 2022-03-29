<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class SignupTest extends TestCase
{
    public function testGetEmail(): void
    {
        $signup = new \App\Models\Signup('EmailTest', 'PasswordTest', 'NameTest','SurnameTest', 'BirthdayTest');
        $this->assertSame('EmailTest', $signup->getEmail());
    }

    public function testGetPassword(): void
    {
        $signup = new \App\Models\Signup('EmailTest', 'PasswordTest', 'NameTest','SurnameTest', 'BirthdayTest');
        $this->assertSame('PasswordTest', $signup->getPassword());
    }

    public function testGetName(): void
    {
        $signup = new \App\Models\Signup('EmailTest', 'PasswordTest', 'NameTest','SurnameTest', 'BirthdayTest');
        $this->assertSame('NameTest', $signup->getName());
    }

    public function testGetSurname(): void
    {
        $signup = new \App\Models\Signup('EmailTest', 'PasswordTest', 'NameTest','SurnameTest', 'BirthdayTest');
        $this->assertSame('SurnameTest', $signup->getSurname());
    }

    public function testGetBirthday(): void
    {
        $signup = new \App\Models\Signup('EmailTest', 'PasswordTest', 'NameTest','SurnameTest', 'BirthdayTest');
        $this->assertSame('BirthdayTest', $signup->getBirthday());
    }

}