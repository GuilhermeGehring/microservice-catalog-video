<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Throwable;

class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            name: 'New Cat',
            description: 'New desc',
            isActive: true
        );

        $this->assertNotEmpty($category->id());
        $this->assertEquals('New Cat', $category->name);
        $this->assertEquals('New desc', $category->description);
        $this->assertNotEmpty($category->createdAt());
        $this->assertEquals(true, $category->isActive);
    }

    public function testActivated()
    {
        $category = new Category(
            name: 'New Cat',
            isActive: false
        );

        $this->assertFalse($category->isActive);
        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function testDisabled()
    {
        $category = new Category(
            name: 'New Cat'
        );

        $this->assertTrue($category->isActive);
        $category->disable();
        $this->assertFalse($category->isActive);
    }

    public function testUpdate()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $createdAt = '2020-01-01 00:00:00';

        $category = new Category(
            id: $uuid,
            name: 'New Cat',
            description: 'New Cat Description',
            isActive: true,
            createdAt: $createdAt
        );

        $category->update(
            name: 'new_name',
            description: 'new_description',
        );

        $this->assertEquals($uuid, $category->id);
        $this->assertEquals('new_name', $category->name);
        $this->assertEquals('new_description', $category->description);
        $this->assertEquals($createdAt, $category->createdAt->format('Y-m-d H:i:s'));
    }

    public function testExceptionName()
    {
        try {
            new Category(
                name: 'N',
                description: 'New Cat Description'
            );

            $this->assertTrue(true);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}
