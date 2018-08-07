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
     * @var string|null
     */
    protected $extends;

    /**
     * @var string[]|array
     */
    protected $extendedBy = [];

    /**
     * @param string|TypeDefinition $type
     * @return TypeDefinition
     */
    abstract protected function fetch($type): TypeDefinition;

    /**
     * @return iterable|TypeDefinition[]
     */
    public function getChildrenInheritance(): iterable
    {
        foreach ($this->extendedBy as $parent) {
            yield $this->fetch($parent);
        }
    }

    /**
     * @return null|TypeDefinition
     */
    public function getParentInheritance(): ?TypeDefinition
    {
        return $this->extends ? $this->fetch($this->extends) : null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasParent(): bool
    {
        return $this->extends !== null;
    }

    /**
     * @param TypeDefinition|string $definition
     * @return ProvidesInheritance|$this
     */
    public function extends($definition): ProvidesInheritance
    {
        $this->extends = $this->nameOf($definition);

        if ($definition instanceof ProvidesInheritance) {
            $definition->extendsBy($this);
        }

        return $this;
    }

    /**
     * @param string|TypeDefinition $definition
     */
    private function extendsBy($definition): void
    {
        $this->extendedBy[] = $this->nameOf($definition);
    }

    /**
     * @param string|TypeDefinition $type
     * @return bool
     */
    public function isExtends($type): bool
    {
        $definition = $this->fetch($type);

        if ($parent = $this->getParentInheritance()) {
            return $parent->instanceOf($definition);
        }

        return false;
    }
}
