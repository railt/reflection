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
use Railt\Reflection\Definition\Dependent\InputFieldDefinition;
use Railt\Reflection\Definition\InputDefinition;
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
        $reflection = new Reflection();

        $this->assertFalse($reflection->has('asd'));
        $this->assertNull($reflection->find('asd'));
        $this->assertCount(10, \iterator_to_array($reflection->all()));
        $this->assertCount(1, $reflection->getDocuments());
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
        $this->assertCount(10, \iterator_to_array($reflection->all()));
        $this->assertCount(2, $reflection->getDocuments());
    }

    /**
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \PHPUnit\Framework\Exception
     */
    public function testReflectionWithDocument(): void
    {
        $reflection = new Reflection();
        $document = new Document($reflection);
        $document->withDefinition(new ObjectDefinition($document, 'Object'));

        $this->assertTrue($reflection->has('Object'));
        $this->assertInstanceOf(ObjectDefinition::class, $reflection->find('Object'));
        $this->assertCount(11, \iterator_to_array($reflection->all()));
        $this->assertCount(2, $reflection->getDocuments());
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

        $this->assertCount(2, $reflection->getDocuments());

        // Sources collision
        $reflection = new Reflection();
        new Document($reflection, File::fromSources(' '));
        new Document($reflection, File::fromSources(' '));

        $this->assertCount(2, $reflection->getDocuments());

        // Different sources
        $reflection = new Reflection();
        new Document($reflection, File::fromSources(' '));
        new Document($reflection, File::fromSources('  '));

        $this->assertCount(3, $reflection->getDocuments());
    }


    /**
     * @throws \PHPUnit\Framework\Exception
     * @throws \Railt\Reflection\Exception\TypeNotFoundException
     */
    public function testReflectionTypesDuplication(): void
    {
        $reflection = new Reflection();
        $doc = new Document($reflection, File::fromSources(\str_repeat(' ', 20)));

        $reflection->add(new ObjectDefinition($doc, 'Test'));
        $this->assertEquals(1, $reflection->get('Test')->getColumn());

        $reflection->add((new ObjectDefinition($doc, 'Test'))->withOffset(10));
        $this->assertEquals(11, $reflection->get('Test')->getColumn());
    }
}
