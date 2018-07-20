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
use Railt\Reflection\Contracts\Definition\Dependent\ArgumentDefinition;
use Railt\Reflection\Contracts\Definition\Dependent\DirectiveLocation;
use Railt\Reflection\Contracts\Definition\DirectiveDefinition as DirectiveDefinitionInterface;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Definition\Behaviour\HasArguments;
use Railt\Reflection\Definition\Behaviour\HasLocations;
use Railt\Reflection\Type;

/**
 * Class DirectiveDefinition
 */
class DirectiveDefinition extends AbstractTypeDefinition implements DirectiveDefinitionInterface
{
    use HasArguments;
    use HasLocations;

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::DIRECTIVE);
    }

    /**
     * @param TypeDefinition $definition
     * @return bool
     */
    public function isAllowedFor(TypeDefinition $definition): bool
    {
        foreach ($this->locations as $location) {
            if ($location->isAllowedFor($definition::getType())) {
                return true;
            }
        }

        return false;
    }
}
