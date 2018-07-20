<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesArguments;
use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesLocations;

/**
 * Interface DirectiveDefinition
 */
interface DirectiveDefinition extends ProvidesArguments, ProvidesLocations, TypeDefinition
{
    /**
     * @param TypeDefinition $definition
     * @return bool
     */
    public function isAllowedFor(TypeDefinition $definition): bool;
}
