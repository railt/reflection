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
 * Class ScalarInheritanceTestCase
 */
class ScalarInheritanceTestCase extends TypeInheritanceTestCase
{
    /**
     * @return array
     */
    public function inheritanceDataProvider(): array
    {
        return [
            'Is a type of ' . Type::DIRECTIVE    => [Type::SCALAR, Type::DIRECTIVE, false],
            'Is a type of ' . Type::ENUM         => [Type::SCALAR, Type::ENUM, false],
            'Is a type of ' . Type::INPUT_OBJECT => [Type::SCALAR, Type::INPUT_OBJECT, false],
            'Is a type of ' . Type::INPUT_UNION  => [Type::SCALAR, Type::INPUT_UNION, false],
            'Is a type of ' . Type::INTERFACE    => [Type::SCALAR, Type::INTERFACE, false],
            'Is a type of ' . Type::OBJECT       => [Type::SCALAR, Type::OBJECT, false],
            'Is a type of ' . Type::SCALAR       => [Type::SCALAR, Type::SCALAR, true],
            'Is a type of ' . Type::SCHEMA       => [Type::SCALAR, Type::SCHEMA, false],
            'Is a type of ' . Type::UNION        => [Type::SCALAR, Type::UNION, false],
            'Is a type of ' . Type::ANY          => [Type::SCALAR, Type::ANY, true],
        ];
    }
}
