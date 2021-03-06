<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Invocation;

use Railt\Reflection\Contracts\Definition;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Definition\Behaviour\Nameable;

/**
 * Interface TypeInvocation
 */
interface TypeInvocation extends Definition, Nameable
{
    /**
     * @return TypeDefinition
     */
    public function getDefinition(): TypeDefinition;
}
