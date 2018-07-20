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
 * Class EnumInheritanceTestCase
 */
class EnumInheritanceTestCase extends TypeInheritanceTestCase
{
    /**
     * @return array
     */
    public function inheritanceDataProvider(): array
    {
        return [
            'Is a type of ' . Type::DIRECTIVE    => [Type::ENUM, Type::DIRECTIVE, false],
            'Is a type of ' . Type::ENUM         => [Type::ENUM, Type::ENUM, true],
            'Is a type of ' . Type::INPUT_OBJECT => [Type::ENUM, Type::INPUT_OBJECT, false],
            'Is a type of ' . Type::INPUT_UNION  => [Type::ENUM, Type::INPUT_UNION, false],
            'Is a type of ' . Type::INTERFACE    => [Type::ENUM, Type::INTERFACE, false],
            'Is a type of ' . Type::OBJECT       => [Type::ENUM, Type::OBJECT, false],
            'Is a type of ' . Type::SCALAR       => [Type::ENUM, Type::SCALAR, true],
            'Is a type of ' . Type::SCHEMA       => [Type::ENUM, Type::SCHEMA, false],
            'Is a type of ' . Type::UNION        => [Type::ENUM, Type::UNION, false],
            'Is a type of ' . Type::ANY          => [Type::ENUM, Type::ANY, true],
        ];
    }
}
