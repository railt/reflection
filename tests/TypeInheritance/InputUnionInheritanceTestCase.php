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
 * Class InputUnionInheritanceTestCase
 */
class InputUnionInheritanceTestCase extends TypeInheritanceTestCase
{
    /**
     * @return array
     */
    public function inheritanceDataProvider(): array
    {
        return [
            'Is a type of ' . Type::DIRECTIVE    => [Type::INPUT_UNION, Type::DIRECTIVE, false],
            'Is a type of ' . Type::ENUM         => [Type::INPUT_UNION, Type::ENUM, false],
            'Is a type of ' . Type::INPUT_OBJECT => [Type::INPUT_UNION, Type::INPUT_OBJECT, false],
            'Is a type of ' . Type::INPUT_UNION  => [Type::INPUT_UNION, Type::INPUT_UNION, true],
            'Is a type of ' . Type::INTERFACE    => [Type::INPUT_UNION, Type::INTERFACE, false],
            'Is a type of ' . Type::OBJECT       => [Type::INPUT_UNION, Type::OBJECT, false],
            'Is a type of ' . Type::SCALAR       => [Type::INPUT_UNION, Type::SCALAR, false],
            'Is a type of ' . Type::SCHEMA       => [Type::INPUT_UNION, Type::SCHEMA, false],
            'Is a type of ' . Type::UNION        => [Type::INPUT_UNION, Type::UNION, true],
            'Is a type of ' . Type::ANY          => [Type::INPUT_UNION, Type::ANY, true],
        ];
    }
}
