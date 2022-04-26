<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;

class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        try {
            $value = '';
            DomainValidation::notNull($value);

            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function testNotNullCustomMessageException()
    {
        try {
            $value = '';
            DomainValidation::notNull($value, 'custom message error');

            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, 'custom message error');
        }
    }

    public function testStrMaxLength()
    {
        try {
            $value = 'Teste';
            DomainValidation::strMaxLength($value, 5, 'custom message max');

            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, 'custom message max');
        }
    }

    public function testStrMinLength()
    {
        try {
            $value = 'teste';
            DomainValidation::strMinLength($value, 7, 'custom message min');

            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, 'custom message min');
        }
    }

    public function testStrCanNullAndMaxLength()
    {
        try {
            $value = 'teste';
            DomainValidation::strCanNullAndMaxLength($value, 2, 'custom message');

            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, 'custom message');
        }
    }
}
