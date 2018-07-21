<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition;

use Railt\Reflection\AbstractTypeDefinition;
use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesTypeDefinitions;
use Railt\Reflection\Contracts\Definition\InputUnionDefinition as InputUnionDefinitionInterface;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Definition\Behaviour\HasDefinitions;
use Railt\Reflection\Type;

/**
 * Class UnionDefinition
 */
class UnionDefinition extends AbstractTypeDefinition implements InputUnionDefinitionInterface
{
    use HasDefinitions {
        withDefinition as private __withDefinition;
    }

    /**
     * @return TypeInterface
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::UNION);
    }

    /**
     * @param string|TypeDefinition $type
     * @return ProvidesTypeDefinitions
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public function withDefinition($type): ProvidesTypeDefinitions
    {
        $instance = $this->fetch($type);

        $this->verifyOutputType($instance);

        return $this->__withDefinition($instance);
    }
}
