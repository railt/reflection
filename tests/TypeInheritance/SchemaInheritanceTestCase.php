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

/**
 * Class SchemaInheritanceTestCase
 */
class SchemaInheritanceTestCase extends TypeInheritanceTestCase
{
    /**
     * @return array
     */
    public function inheritanceDataProvider(): array
    {
        return [
            Type::SCHEMA . ' typeOf ' . Type::DIRECTIVE    => [Type::SCHEMA, Type::DIRECTIVE, false],
            Type::SCHEMA . ' typeOf ' . Type::ENUM         => [Type::SCHEMA, Type::ENUM, false],
            Type::SCHEMA . ' typeOf ' . Type::INPUT_OBJECT => [Type::SCHEMA, Type::INPUT_OBJECT, false],
            Type::SCHEMA . ' typeOf ' . Type::INPUT_UNION  => [Type::SCHEMA, Type::INPUT_UNION, false],
            Type::SCHEMA . ' typeOf ' . Type::INTERFACE    => [Type::SCHEMA, Type::INTERFACE, false],
            Type::SCHEMA . ' typeOf ' . Type::OBJECT       => [Type::SCHEMA, Type::OBJECT, false],
            Type::SCHEMA . ' typeOf ' . Type::SCALAR       => [Type::SCHEMA, Type::SCALAR, false],
            Type::SCHEMA . ' typeOf ' . Type::SCHEMA       => [Type::SCHEMA, Type::SCHEMA, true],
            Type::SCHEMA . ' typeOf ' . Type::UNION        => [Type::SCHEMA, Type::UNION, false],
            Type::SCHEMA . ' typeOf ' . Type::ANY          => [Type::SCHEMA, Type::ANY, true],
        ];
    }
}
