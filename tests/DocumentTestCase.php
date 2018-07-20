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
use Railt\Reflection\Definition\DirectiveDefinition;
use Railt\Reflection\Definition\ObjectDefinition;
use Railt\Reflection\Document;
use Railt\Reflection\Invocation\DirectiveInvocation;
use Railt\Reflection\Reflection;

/**
 * Class DocumentTestCase
 */
class DocumentTestCase extends TestCase
{
    /**
     * @return Document
     * @throws \Railt\Io\Exception\NotReadableException
     */
    private function mock(): Document
    {
        return new Document(new Reflection());
    }

    /**
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \PHPUnit\Framework\Exception
     * @throws \Railt\Reflection\Exception\TypeNotFoundException
     * @throws \Railt\Io\Exception\NotReadableException
     */
    public function testEmptyDocument(): void
    {
        $document = $this->mock();
        $hash = File::fromSources('')->getHash();

        // File
        $this->assertEquals(1, $document->getColumn());
        $this->assertEquals(1, $document->getLine());
        $this->assertNotNull($document->getFile());

        // Info
        $this->assertEquals($hash, $document->getName());

        // Environment
        $this->assertNotNull($document->getDocument());
        $this->assertInstanceOf(\Railt\Reflection\Contracts\Dictionary::class, $document->getDictionary());

        // Deprecation
        $this->assertEquals('', $document->getDeprecationReason());
        $this->assertFalse($document->isDeprecated());

        // Types
        $this->assertNull($document->getDefinition('test'));
        $this->assertFalse($document->hasDefinition('test'));
        $this->assertCount(0, $document->getDefinitions());
        $this->assertCount(0, $document->getDirectives('test'));
        $this->assertFalse($document->hasDirective('test'));
    }

    /**
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \PHPUnit\Framework\Exception
     * @throws \Railt\Reflection\Exception\TypeNotFoundException
     * @throws \Railt\Io\Exception\NotReadableException
     */
    public function testDocumentWithObject(): void
    {
        $document = $this->mock();
        $document->withDefinition(new ObjectDefinition($document, 'test'));

        $this->assertInstanceOf(ObjectDefinition::class, $document->getDefinition('test'));
        $this->assertTrue($document->hasDefinition('test'));
        $this->assertCount(1, $document->getDefinitions());
        $this->assertCount(0, $document->getDirectives('test'));
        $this->assertFalse($document->hasDirective('test'));
    }

    /**
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \PHPUnit\Framework\Exception
     * @throws \Railt\Reflection\Exception\TypeNotFoundException
     * @throws \Railt\Io\Exception\NotReadableException
     */
    public function testDocumentWithAnotherDocument(): void
    {
        $document = $this->mock();
        $document2 = new Document($document->getDictionary());
        $document2->withDefinition(new ObjectDefinition($document2, 'test'));

        $this->assertNull($document->getDefinition('test'));
        $this->assertFalse($document->hasDefinition('test'));
        $this->assertCount(0, $document->getDefinitions());
        $this->assertCount(0, $document->getDirectives('test'));
        $this->assertFalse($document->hasDirective('test'));
    }

    /**
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \PHPUnit\Framework\Exception
     * @throws \Railt\Reflection\Exception\TypeNotFoundException
     * @throws \Railt\Io\Exception\NotReadableException
     */
    public function testDocumentWithDirectives(): void
    {
        $document = $this->mock();
        $document->withDefinition(new DirectiveDefinition($document, 'test'));
        $document->withDirective(new DirectiveInvocation($document, 'test'));

        $this->assertInstanceOf(\Railt\Reflection\Contracts\Definition\DirectiveDefinition::class,
            $document->getDefinition('test'));
        $this->assertTrue($document->hasDefinition('test'));
        $this->assertCount(1, $document->getDefinitions());
        $this->assertCount(1, $document->getDirectives('test'));
        $this->assertTrue($document->hasDirective('test'));
    }
}
