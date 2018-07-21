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
 * Class UnionInheritanceTestCase
 */
class UnionInheritanceTestCase extends TypeInheritanceTestCase
{
    /**
     * @return array
     */
    public function inheritanceDataProvider(): array
    {
        return [
            'Is a type of ' . Type::DIRECTIVE    => [Type::UNION, Type::DIRECTIVE, false],
            'Is a type of ' . Type::ENUM         => [Type::UNION, Type::ENUM, false],
            'Is a type of ' . Type::INPUT_OBJECT => [Type::UNION, Type::INPUT_OBJECT, false],
            'Is a type of ' . Type::INPUT_UNION  => [Type::UNION, Type::INPUT_UNION, false],
            'Is a type of ' . Type::INTERFACE    => [Type::UNION, Type::INTERFACE, false],
            'Is a type of ' . Type::OBJECT       => [Type::UNION, Type::OBJECT, false],
            'Is a type of ' . Type::SCALAR       => [Type::UNION, Type::SCALAR, false],
            'Is a type of ' . Type::SCHEMA       => [Type::UNION, Type::SCHEMA, false],
            'Is a type of ' . Type::UNION        => [Type::UNION, Type::UNION, true],
            'Is a type of ' . Type::ANY          => [Type::UNION, Type::ANY, true],
        ];
    }
}
