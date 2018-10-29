<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesArguments;
use Railt\Reflection\Definition\Dependent\ArgumentDefinition;
use Railt\Reflection\Contracts\Definition\Dependent\ArgumentDefinition as ArgumentDefinitionInterface;

/**
 * Trait HasArguments
 */
trait HasArguments
{
    /**
     * @var array|ArgumentDefinition[]
     */
    protected $arguments = [];

    /**
     * @return iterable|ArgumentDefinition[]
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
     * @return null|ArgumentDefinitionInterface
     */
    public function getArgument(string $name): ?ArgumentDefinitionInterface
    {
        return $this->arguments[$name] ?? null;
    }

    /**
     * @param ArgumentDefinitionInterface ...$arguments
     * @return ProvidesArguments|$this
     */
    public function withArgument(ArgumentDefinitionInterface ...$arguments): ProvidesArguments
    {
        foreach ($arguments as $argument) {
            $this->arguments[$argument->getName()] = $argument;
        }

        return $this;
    }

    /**
     * @param string|ArgumentDefinitionInterface ...$arguments
     * @return ProvidesArguments|$this
     */
    public function withoutArgument(...$arguments)
    {
        foreach ($arguments as $argument) {
            unset($this->arguments[$this->nameOf($argument)]);
        }

        return $this;
    }
}
