<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Tests\Reflection;

use Railt\Io\File;
use Railt\Reflection\Definition\ObjectDefinition;
use Railt\Reflection\Document;
use Railt\Reflection\Reflection;

/**
 * Class ReflectionTestCase
 */
class ReflectionTestCase extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \PHPUnit\Framework\Exception
     */
    public function testEmptyReflection(): void
    {
        $ref = new Reflection();

        $this->assertFalse($ref->has('asd'));
        $this->assertNull($ref->find('asd'));
        $this->assertCount(0, $ref->all());
        $this->assertCount(0, $ref->getDocuments());
    }

    /**
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \PHPUnit\Framework\Exception
     */
    public function testReflectionWithEmptyDocument(): void
    {
        $reflection = new Reflection();
        new Document($reflection);

        $this->assertFalse($reflection->has('asd'));
        $this->assertNull($reflection->find('asd'));
        $this->assertCount(0, $reflection->all());
        $this->assertCount(1, $reflection->getDocuments());
    }

    /**
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \PHPUnit\Framework\Exception
     */
    public function testReflectionWithDocument(): void
    {
        $reflection = new Reflection();
        $document = new Document($reflection);
        $type = new ObjectDefinition($document, 'Object');

        $this->assertTrue($reflection->has('Object'));
        $this->assertInstanceOf(ObjectDefinition::class, $reflection->find('Object'));
        $this->assertCount(1, $reflection->all());
        $this->assertCount(1, $reflection->getDocuments());
    }

    /**
     * @throws \PHPUnit\Framework\Exception
     */
    public function testReflectionDocumentDuplication(): void
    {
        // No file (virtual)
        $reflection = new Reflection();
        new Document($reflection);
        new Document($reflection);

        $this->assertCount(1, $reflection->getDocuments());

        // Sources collision
        $reflection = new Reflection();
        new Document($reflection, File::fromSources(' '));
        new Document($reflection, File::fromSources(' '));

        $this->assertCount(1, $reflection->getDocuments());

        // Different sources
        $reflection = new Reflection();
        new Document($reflection, File::fromSources(' '));
        new Document($reflection, File::fromSources('  '));

        $this->assertCount(2, $reflection->getDocuments());
    }


    /**
     * @throws \PHPUnit\Framework\Exception
     * @throws \Railt\Reflection\Exception\TypeNotFoundException
     */
    public function testReflectionTypesDuplication(): void
    {
        $reflection = new Reflection();
        $file = new Document($reflection, File::fromSources(\str_repeat(' ', 20)));

        new ObjectDefinition($file, 'Test');
        $this->assertEquals(1, $reflection->get('Test')->getColumn());

        $obj = new ObjectDefinition($file, 'Test');
        $obj->setOffset(10);
        $this->assertEquals(11, $reflection->get('Test')->getColumn());
    }
}
