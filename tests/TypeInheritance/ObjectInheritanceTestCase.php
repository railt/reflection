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
 * Class ObjectInheritanceTestCase
 */
class ObjectInheritanceTestCase extends TypeInheritanceTestCase
{
    /**
     * @return array
     */
    public function inheritanceDataProvider(): array
    {
        return [
            'Is a type of ' . Type::DIRECTIVE    => [Type::OBJECT, Type::DIRECTIVE, true],
            'Is a type of ' . Type::ENUM         => [Type::OBJECT, Type::ENUM, false],
            'Is a type of ' . Type::INPUT_OBJECT => [Type::OBJECT, Type::INPUT_OBJECT, false],
            'Is a type of ' . Type::INPUT_UNION  => [Type::OBJECT, Type::INPUT_UNION, false],
            'Is a type of ' . Type::INTERFACE    => [Type::OBJECT, Type::INTERFACE, false],
            'Is a type of ' . Type::OBJECT       => [Type::OBJECT, Type::OBJECT, false],
            'Is a type of ' . Type::SCALAR       => [Type::OBJECT, Type::SCALAR, false],
            'Is a type of ' . Type::SCHEMA       => [Type::OBJECT, Type::SCHEMA, false],
            'Is a type of ' . Type::UNION        => [Type::OBJECT, Type::UNION, false],
            'Is a type of ' . Type::ANY          => [Type::OBJECT, Type::ANY, true],
        ];
    }
}
