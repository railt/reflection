<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesInheritance;
use Railt\Reflection\Contracts\Definition\TypeDefinition;

/**
 * Trait HasInheritance
 */
trait HasInheritance
{
    /**
     * @var array|string[]
     */
    protected $parents = [];

    /**
     * @param string|TypeDefinition $type
     * @return TypeDefinition
     */
    abstract protected function fetch($type): TypeDefinition;

    /**
     * @return iterable|TypeDefinition[]
     */
    public function getParents(): iterable
    {
        foreach ($this->parents as $parent) {
            yield $this->fetch($parent);
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasParent(string $name): bool
    {
        return \in_array($name, $this->parents, true);
    }

    /**
     * @param string $name
     * @return null|TypeDefinition
     */
    public function getParent(string $name): ?TypeDefinition
    {
        return \in_array($name, $this->parents, true) ? $this->fetch($name) : null;
    }

    /**
     * @param TypeDefinition|string ...$definitions
     * @return ProvidesInheritance|$this
     */
    public function extends(...$definitions): ProvidesInheritance
    {
        foreach ($definitions as $definition) {
            $definition = $definition instanceof TypeDefinition ? $definition->getName() : $definition;

            $this->parents[] = $definition->getName();
        }

        return $this;
    }

    /**
     * @param string|TypeDefinition $type
     * @return bool
     */
    public function isExtends($type): bool
    {
        $definition = $this->fetch($type);

        foreach ($this->getParents() as $parent) {
            if ($parent->instanceOf($definition)) {
                return true;
            }
        }

        return false;
    }
}
