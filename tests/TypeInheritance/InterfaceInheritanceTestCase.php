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
 * Class InterfaceInheritanceTestCase
 */
class InterfaceInheritanceTestCase extends TypeInheritanceTestCase
{
    /**
     * @return array
     */
    public function inheritanceDataProvider(): array
    {
        return [
            'Is a type of ' . Type::DIRECTIVE    => [Type::INTERFACE, Type::DIRECTIVE, false],
            'Is a type of ' . Type::ENUM         => [Type::INTERFACE, Type::ENUM, false],
            'Is a type of ' . Type::INPUT_OBJECT => [Type::INTERFACE, Type::INPUT_OBJECT, false],
            'Is a type of ' . Type::INPUT_UNION  => [Type::INTERFACE, Type::INPUT_UNION, false],
            'Is a type of ' . Type::INTERFACE    => [Type::INTERFACE, Type::INTERFACE, true],
            'Is a type of ' . Type::OBJECT       => [Type::INTERFACE, Type::OBJECT, false],
            'Is a type of ' . Type::SCALAR       => [Type::INTERFACE, Type::SCALAR, false],
            'Is a type of ' . Type::SCHEMA       => [Type::INTERFACE, Type::SCHEMA, false],
            'Is a type of ' . Type::UNION        => [Type::INTERFACE, Type::UNION, false],
            'Is a type of ' . Type::ANY          => [Type::INTERFACE, Type::ANY, true],
        ];
    }
}
