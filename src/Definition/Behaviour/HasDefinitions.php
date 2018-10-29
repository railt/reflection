<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesTypeDefinitions;
use Railt\Reflection\Contracts\Definition\TypeDefinition;

/**
 * Trait HasDefinitions
 */
trait HasDefinitions
{
    /**
     * @var array|string[]
     */
    protected $types = [];

    /**
     * @param string|TypeDefinition $type
     * @return TypeDefinition
     */
    abstract protected function fetch($type): TypeDefinition;

    /**
     * @return iterable|TypeDefinition[]
     */
    public function getDefinitions(): iterable
    {
        foreach ($this->types as $type) {
            yield $this->fetch($type);
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasDefinition(string $name): bool
    {
        return \in_array($name, $this->types, true);
    }

    /**
     * @param string $name
     * @return null|TypeDefinition
     */
    public function getDefinition(string $name): ?TypeDefinition
    {
        if (! \in_array($name, $this->types, true)) {
            return null;
        }

        return $this->fetch($name);
    }

    /**
     * @param string|TypeDefinition ...$types
     * @return ProvidesTypeDefinitions|$this
     */
    public function withDefinition(...$types): ProvidesTypeDefinitions
    {
        foreach ($types as $type) {
            $this->types[] = $this->nameOf($type);
        }

        return $this;
    }

    /**
     * @param string|TypeDefinition ...$types
     * @return ProvidesTypeDefinitions|$this
     */
    public function withoutDefinition(...$types): ProvidesTypeDefinitions
    {
        foreach ($types as $type) {
            if ($this->hasDefinition($this->nameOf($type))) {
                array_splice($this->types, array_search($this->types, $this->nameOf($type)), 1);
            }
        }

        return $this;
    }
}
