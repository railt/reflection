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
 * Class DirectiveInheritanceTestCase
 */
class DirectiveInheritanceTestCase extends TypeInheritanceTestCase
{
    /**
     * @return array
     */
    public function inheritanceDataProvider(): array
    {
        return [
            'Is a type of ' . Type::DIRECTIVE    => [Type::DIRECTIVE, Type::DIRECTIVE, true],
            'Is a type of ' . Type::ENUM         => [Type::DIRECTIVE, Type::ENUM, false],
            'Is a type of ' . Type::INPUT_OBJECT => [Type::DIRECTIVE, Type::INPUT_OBJECT, false],
            'Is a type of ' . Type::INPUT_UNION  => [Type::DIRECTIVE, Type::INPUT_UNION, false],
            'Is a type of ' . Type::INTERFACE    => [Type::DIRECTIVE, Type::INTERFACE, false],
            'Is a type of ' . Type::OBJECT       => [Type::DIRECTIVE, Type::OBJECT, false],
            'Is a type of ' . Type::SCALAR       => [Type::DIRECTIVE, Type::SCALAR, false],
            'Is a type of ' . Type::SCHEMA       => [Type::DIRECTIVE, Type::SCHEMA, false],
            'Is a type of ' . Type::UNION        => [Type::DIRECTIVE, Type::UNION, false],
            'Is a type of ' . Type::ANY          => [Type::DIRECTIVE, Type::ANY, true],
        ];
    }
}
