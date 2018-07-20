<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Tests\Reflection\InstanceInheritance;

use Railt\Reflection\AbstractTypeDefinition as Def;
use Railt\Reflection\Dictionary\SimpleDictionary;
use Railt\Reflection\Document;
use Railt\Reflection\Exception\TypeConflictException;
use Railt\Tests\Reflection\TestCase;

/**
 * Class InheritanceTestCase
 */
abstract class InstanceInheritanceTestCase extends TestCase
{
    /**
     * @return array
     */
    abstract public function inheritanceDataProvider(): array;

    /**
     * @dataProvider inheritanceDataProvider
     * @param Def $original
     * @param Def $extends
     * @param bool $valid
     * @throws \Railt\Reflection\Exception\TypeConflictException
     * @throws \PHPUnit\Framework\Exception
     */
    public function testInheritanceValidation(Def $original, Def $extends, bool $valid): void
    {
        if ($valid) {
            $this->assertInstanceOf(\get_class($original), $original->extends($extends));
        } else {
            $this->expectException(TypeConflictException::class);
            $original->extends($extends);
        }
    }

    /**
     * @dataProvider inheritanceDataProvider
     * @param Def $original
     * @param Def $extends
     * @param bool $valid
     * @throws \PHPUnit\Framework\SkippedTestError
     * @throws TypeConflictException
     * @throws \PHPUnit\Framework\AssertionFailedError
     */
    public function testInheritanceInstanceOf(Def $original, Def $extends, bool $valid): void
    {
        /** @var SimpleDictionary $gql */
        $gql = $original->getDictionary();
        /** @var Document $doc */
        $doc = $original->getDocument();

        if (! $valid) {
            $error = \vsprintf('Skip test "%s extends %s" because type %s could not extends %s', [
                $original,
                $extends,
                $original::getType(),
                $extends::getType()
            ]);
            $this->markTestSkipped($error);
            return;
        }


        $doc->withDefinition($a = (clone $original)->renameTo('a'));
        $doc->withDefinition($b = (clone $original)->renameTo('b'));
        $doc->withDefinition($c = (clone $original)->renameTo('c')->extends($a));
        $doc->withDefinition($d = (clone $original)->renameTo('d')->extends($c));


        $this->assertFalse($a->instanceOf($b));
        $this->assertFalse($a->instanceOf($c));
        $this->assertFalse($a->instanceOf($d));
        $this->assertFalse($b->instanceOf($a));
        $this->assertFalse($b->instanceOf($c));
        $this->assertFalse($b->instanceOf($d));
        $this->assertTrue($c->instanceOf($a)); // C extends A
        $this->assertFalse($c->instanceOf($b));
        $this->assertFalse($c->instanceOf($d));
        $this->assertTrue($d->instanceOf($a)); // D extends C extends A
        $this->assertFalse($d->instanceOf($b));
        $this->assertTrue($d->instanceOf($c)); // D extends C


        $this->assertTrue($a->instanceOf($gql->find('Any')));
        $this->assertTrue($b->instanceOf($gql->find('Any')));
        $this->assertTrue($c->instanceOf($gql->find('Any')));
        $this->assertTrue($d->instanceOf($gql->find('Any')));
    }
}
