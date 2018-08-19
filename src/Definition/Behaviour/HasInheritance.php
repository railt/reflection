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
use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesInterfaces;
use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesTypeDefinitions;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Type;

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
    public function inheritedBy(): iterable
    {
        foreach ($this->extendedBy as $parent) {
            yield $this->fetch($parent);
        }
    }

    /**
     * @return null|TypeDefinition
     */
    public function getInheritedParent(): ?TypeDefinition
    {
        return $this->extends ? $this->fetch($this->extends) : null;
    }

    /**
     * @return bool
     */
    public function hasInheritance(): bool
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
            /** @var HasInheritance $definition */
            $definition->extendedBy[] = $this->getName();
        }

        return $this;
    }

    /**
     * @param TypeDefinition|string $definition
     * @return ProvidesInheritance|$this
     */
    public function extendsBy($definition): ProvidesInheritance
    {
        /** @var HasInheritance $definition */
        $definition = $this->fetch($definition);

        $definition->extends($this);

        return $this;
    }

    /**
     * @param TypeDefinition|string $type
     * @return bool
     */
    public function extendsOf($type): bool
    {
        return $this->extends === $this->nameOf($type);
    }

    /**
     * @param TypeDefinition|string $type
     * @return bool
     */
    public function instanceOf($type): bool
    {
        /**
         * @var TypeDefinition $type
         * @var TypeDefinition $context
         */
        [$type, $context] = [$this->fetch($type), $this];

        // Return a positive response if the child is an Any type implementation.
        if ($type::getType()->is(Type::ANY)) {
            return true;
        }

        // Return a positive response if the desired child is the same type from
        // which the search is performed.
        if ($type === $context) {
            return true;
        }

        // Return a positive response if the parent type (like Object or Interface)
        // can implement the desired type.
        if ($this instanceof ProvidesInterfaces && $this->isImplements($type->getName())) {
            return true;
        }

        // Return a positive response if the parent type (like Union) contains a
        // reference to the desired child type.
        if ($this instanceof ProvidesTypeDefinitions && $this->hasDefinition($type->getName())) {
            return true;
        }

        // Return a positive response if the parent type contains a reference
        // to the desired child when using inheritance.
        while ($context) {
            /** @var TypeDefinition $context */
            $context = $this->fetch($context);

            if ($context->extendsOf($type)) {
                return true;
            }

            $context = $context->getInheritedParent();
        }

        return false;
    }
}
