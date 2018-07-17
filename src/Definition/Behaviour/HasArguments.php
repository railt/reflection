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
 * @mixin ProvidesArguments
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
    public function getArgumentDefinitions(): iterable
    {
        return \array_values($this->arguments);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasArgumentDefinition(string $name): bool
    {
        return isset($this->arguments[$name]);
    }

    /**
     * @param string $name
     * @return null|ArgumentDefinitionInterface
     */
    public function getArgumentDefinition(string $name): ?ArgumentDefinitionInterface
    {
        return $this->arguments[$name] ?? null;
    }

    /**
     * @param ArgumentDefinitionInterface $argument
     */
    public function addArgument(ArgumentDefinitionInterface $argument): void
    {
        $this->arguments[$argument->getName()] = $argument;
    }
}
