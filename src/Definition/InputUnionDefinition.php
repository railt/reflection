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
 * Class InputUnionDefinition
 */
class InputUnionDefinition extends AbstractTypeDefinition implements InputUnionDefinitionInterface
{
    use HasDefinitions {
        withDefinition as private __withDefinition;
    }

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::INPUT_UNION);
    }

    /**
     * @param string|TypeDefinition $type
     * @return ProvidesTypeDefinitions
     */
    public function withDefinition($type): ProvidesTypeDefinitions
    {
        $instance = $this->fetch($type);

        \assert($instance::getType()->isInputable());

        return $this->__withDefinition($instance);
    }
}
