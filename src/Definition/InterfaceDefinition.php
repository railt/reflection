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
use Railt\Reflection\Contracts\Definition\InterfaceDefinition as InterfaceDefinitionInterface;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Definition\Behaviour\HasFields;
use Railt\Reflection\Definition\Behaviour\HasInterfaces;
use Railt\Reflection\Type;

/**
 * Class InterfaceDefinition
 */
class InterfaceDefinition extends AbstractTypeDefinition implements InterfaceDefinitionInterface
{
    use HasInterfaces;
    use HasFields;

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::INTERFACE);
    }

    /**
     * @param TypeDefinition $definition
     * @return bool
     */
    public function instanceOf(TypeDefinition $definition): bool
    {
        return $this->isImplementsDefinition($definition) || parent::instanceOf($definition);
    }
}
