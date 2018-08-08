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
            $definition->extendedBy[] = $this->extends;
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

        if ($type::getType()->is(Type::ANY)) {
            return true;
        }

        if ($type === $context) {
            return true;
        }

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
