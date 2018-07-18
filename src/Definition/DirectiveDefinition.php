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
use Railt\Reflection\Type;

/**
 * Class DirectiveDefinition
 * TODO
 */
class DirectiveDefinition extends AbstractTypeDefinition implements DirectiveDefinitionInterface
{
    use HasArguments;

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::DIRECTIVE);
    }

    public function isAllowedFor(TypeDefinition $definition): bool
    {
        throw new \LogicException(__METHOD__ . ' not implemented yet');
    }

    public function getLocations(): iterable
    {
        throw new \LogicException(__METHOD__ . ' not implemented yet');
    }

    public function getLocation(string $name): ?DirectiveLocation
    {
        throw new \LogicException(__METHOD__ . ' not implemented yet');
    }

    public function hasLocation(string $name): bool
    {
        throw new \LogicException(__METHOD__ . ' not implemented yet');
    }
}
