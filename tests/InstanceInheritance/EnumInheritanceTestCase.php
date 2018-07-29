<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Tests\Reflection\InstanceInheritance;

use Railt\Reflection\Definition\DirectiveDefinition;
use Railt\Reflection\Definition\EnumDefinition;
use Railt\Reflection\Definition\InputDefinition;
use Railt\Reflection\Definition\InputUnionDefinition;
use Railt\Reflection\Definition\InterfaceDefinition;
use Railt\Reflection\Definition\ObjectDefinition;
use Railt\Reflection\Definition\ScalarDefinition;
use Railt\Reflection\Definition\SchemaDefinition;
use Railt\Reflection\Definition\UnionDefinition;
use Railt\Reflection\Document;
use Railt\Reflection\Reflection;
use Railt\Reflection\Type;

/**
 * Class EnumInheritanceTestCase
 */
class EnumInheritanceTestCase extends InstanceInheritanceTestCase
{
    /**
     * @return array
     * @throws \Railt\Reflection\Exception\ReflectionException
     */
    public function inheritanceDataProvider(): array
    {
        $document = new Document($gql = new Reflection());

        $target = new EnumDefinition($document, 'SourceType');

        return [
            Type::DIRECTIVE    => [$target, new DirectiveDefinition($document, 'ChildType'), false],
            Type::ENUM         => [$target, new EnumDefinition($document, 'ChildType'), true],
            Type::INPUT_OBJECT => [$target, new InputDefinition($document, 'ChildType'), false],
            Type::INPUT_UNION  => [$target, new InputUnionDefinition($document, 'ChildType'), false],
            Type::INTERFACE    => [$target, new InterfaceDefinition($document, 'ChildType'), false],
            Type::OBJECT       => [$target, new ObjectDefinition($document, 'ChildType'), false],
            Type::SCALAR       => [$target, new ScalarDefinition($document, 'ChildType'), false],
            Type::SCHEMA       => [$target, new SchemaDefinition($document, 'ChildType'), false],
            Type::UNION        => [$target, new UnionDefinition($document, 'ChildType'), false],
        ];
    }
}
