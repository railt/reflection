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
 * Class InputObjectInheritanceTestCase
 */
class InputObjectInheritanceTestCase extends TypeInheritanceTestCase
{
    /**
     * @return array
     */
    public function inheritanceDataProvider(): array
    {
        return [
            'Is a type of ' . Type::DIRECTIVE    => [Type::INPUT_OBJECT, Type::DIRECTIVE, true],
            'Is a type of ' . Type::ENUM         => [Type::INPUT_OBJECT, Type::ENUM, false],
            'Is a type of ' . Type::INPUT_OBJECT => [Type::INPUT_OBJECT, Type::INPUT_OBJECT, false],
            'Is a type of ' . Type::INPUT_UNION  => [Type::INPUT_OBJECT, Type::INPUT_UNION, false],
            'Is a type of ' . Type::INTERFACE    => [Type::INPUT_OBJECT, Type::INTERFACE, false],
            'Is a type of ' . Type::OBJECT       => [Type::INPUT_OBJECT, Type::OBJECT, false],
            'Is a type of ' . Type::SCALAR       => [Type::INPUT_OBJECT, Type::SCALAR, false],
            'Is a type of ' . Type::SCHEMA       => [Type::INPUT_OBJECT, Type::SCHEMA, false],
            'Is a type of ' . Type::UNION        => [Type::INPUT_OBJECT, Type::UNION, false],
            'Is a type of ' . Type::ANY          => [Type::INPUT_OBJECT, Type::ANY, true],
        ];
    }
}
