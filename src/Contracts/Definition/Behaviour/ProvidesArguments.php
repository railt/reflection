<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Dependent\ArgumentDefinition;

/**
 * The interface indicates that the type is a container that
 * contains a list of valid arguments in the type.
 */
interface ProvidesArguments
{
    /**
     * @return iterable|ArgumentDefinition[]
     */
    public function getArguments(): iterable;

    /**
     * @param string $name
     * @return bool
     */
    public function hasArgument(string $name): bool;

    /**
     * @param string $name
     * @return ArgumentDefinition|null
     */
    public function getArgument(string $name): ?ArgumentDefinition;
}
