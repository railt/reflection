<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Invocation\Behaviour;

/**
 * Interface ProvidesArguments
 */
interface ProvidesArguments extends \IteratorAggregate, \ArrayAccess
{
    /**
     * @return iterable|mixed[]
     */
    public function getArguments(): iterable;

    /**
     * @param string|int $name
     * @return mixed
     */
    public function getArgument($name);

    /**
     * @param string|int $name
     * @return bool
     */
    public function hasArgument($name): bool;
}
