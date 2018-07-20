<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation\Behaviour;

use Railt\Reflection\Contracts\Invocation\Behaviour\ProvidesPassedArguments;
use Railt\Reflection\Contracts\Invocation\Dependent\ArgumentInvocation;

/**
 * Trait HasPassedArguments
 * @mixin ProvidesPassedArguments
 */
trait HasPassedArguments
{
    /**
     * @var array|ArgumentInvocation[]
     */
    protected $arguments = [];

    /**
     * @return iterable|ArgumentInvocation[]
     */
    public function getArguments(): iterable
    {
        return \array_values($this->arguments);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasArgument(string $name): bool
    {
        return isset($this->arguments[$name]);
    }

    /**
     * @param string $name
     * @return null|ArgumentInvocation
     */
    public function getArgument(string $name): ?ArgumentInvocation
    {
        return $this->arguments[$name] ?? null;
    }

    /**
     * @param ArgumentInvocation ...$arguments
     * @return ProvidesPassedArguments|$this
     */
    public function withArgument(ArgumentInvocation ...$arguments): ProvidesPassedArguments
    {
        foreach ($arguments as $argument) {
            $this->arguments[$argument->getName()] = $argument;
        }

        return $this;
    }
}
