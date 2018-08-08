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
     * @throws \PHPUnit\Framework\Exception
     */
    public function testInheritanceValidation(Def $original, Def $extends, bool $valid): void
    {
        if ($valid) {
            $this->assertInstanceOf(\get_class($original), $original->extends($extends));
        } else {
            $this->markTestSkipped(
                \sprintf('Could not test invalid types inheritance (%s extends %s)', $original, $extends)
            );
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


        /**
         * Inheritance code
         * <code>
         *  type A {}
         *  type B {}
         *  type C extends A {}
         *  type D extends C {}
         * </code>
         */
        $doc->withDefinition($a = (clone $original)->renameTo('A'));
        $doc->withDefinition($c = (clone $original)->renameTo('C')->extends($a));
        $doc->withDefinition($d = (clone $original)->renameTo('D')->extends($c));
        $doc->withDefinition($b = (clone $original)->renameTo('B'));

        /**
         * Types inheritance graph
         * <code>
         * - [A] instanceof A + Any
         *    ∟ [C] instanceof C + A + Any
         *        ∟ [D] instanceof D + C + A + Any
         * - [B] instanceof B + Any
         * </code>
         */

        // Positive A
        $this->assertTrue($a->instanceOf($a));
        $this->assertTrue($a->instanceOf($gql->find('Any')));

        // Positive B
        $this->assertTrue($b->instanceOf($gql->find('Any')));

        // Positive C
        $this->assertTrue($c->instanceOf($c));
        $this->assertTrue($c->instanceOf($a));
        $this->assertTrue($c->instanceOf($gql->find('Any')));

        // Positive D
        $this->assertTrue($d->instanceOf($d));
        $this->assertTrue($d->instanceOf($c));
        $this->assertTrue($d->instanceOf($a));
        $this->assertTrue($d->instanceOf($gql->find('Any')));


        // Negative A
        $this->assertFalse($a->instanceOf($b));
        $this->assertFalse($a->instanceOf($c));
        $this->assertFalse($a->instanceOf($d));

        // Negative B
        $this->assertFalse($b->instanceOf($a));
        $this->assertFalse($b->instanceOf($c));
        $this->assertFalse($b->instanceOf($d));

        // Negative C
        $this->assertFalse($c->instanceOf($b));
        $this->assertFalse($c->instanceOf($d));

        // Negative D
        $this->assertFalse($d->instanceOf($b));
    }
}
