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
use Railt\Reflection\Definition\InterfaceDefinition;
use Railt\Reflection\Definition\ObjectDefinition;
use Railt\Reflection\Definition\ScalarDefinition;
use Railt\Reflection\Document;
use Railt\Reflection\Reflection;
use Railt\Reflection\Type;

/**
 * Class ObjectInheritanceTestCase
 */
class ObjectInheritanceTestCase extends InstanceInheritanceTestCase
{
    /**
     * @return array
     */
    public function inheritanceDataProvider(): array
    {
        $document = new Document($gql = new Reflection());

        $target = new ObjectDefinition($document, 'SourceType');

        return [
            Type::DIRECTIVE      => [$target, new DirectiveDefinition($document, 'ChildType'), false],
            Type::ENUM           => [$target, new EnumDefinition($document, 'ChildType'), false],
            //Type::INPUT_OBJECT => [$target, new InputDefinition($document, 'ChildType'), false],
            //Type::INPUT_UNION  => [$target, new InputUnionDefinition($document, 'ChildType'), false],
            Type::INTERFACE      => [$target, new InterfaceDefinition($document, 'ChildType'), true],
            Type::OBJECT         => [$target, new ObjectDefinition($document, 'ChildType'), true],
            Type::SCALAR         => [$target, new ScalarDefinition($document, 'ChildType'), false],
            //Type::SCHEMA       => [$target, new SchemaDefinition($document, 'ChildType'), true],
            //Type::UNION        => [$target, new UnionDefinition($document, 'ChildType'), true],
        ];
    }
}
