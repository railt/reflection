<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Tests\Reflection\TypeInheritance;

use Railt\Reflection\Type;
use Railt\Tests\Reflection\TestCase;

/**
 * Class TypeInheritanceTestCase
 */
abstract class TypeInheritanceTestCase extends TestCase
{
    /**
     * @return array
     */
    abstract public function inheritanceDataProvider(): array;

    /**
     * @dataProvider inheritanceDataProvider
     * @param string $type
     * @param string $of
     * @param bool $valid
     * @throws \PHPUnit\Framework\Exception
     */
    public function testTypeOf(string $type, string $of, bool $valid): void
    {
        $this->assertEquals($valid, Type::of($type)->instanceOf(Type::of($of)),
            \sprintf('"%s type of %s" should be %s', Type::of($type), Type::of($of), $valid ? 'true' : 'false'));
    }
}
