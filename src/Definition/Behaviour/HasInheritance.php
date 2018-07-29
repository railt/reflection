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
use Railt\Reflection\Exception\TypeConflictException;

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
     * @param TypeDefinition ...$definitions
     * @return ProvidesInheritance|$this
     * @throws TypeConflictException
     */
    public function extends(TypeDefinition ...$definitions): ProvidesInheritance
    {
        foreach ($definitions as $definition) {
            $this->verifyExtensionType($definition);

            $this->parents[] = $definition->getName();
        }

        return $this;
    }

    /**
     * @param TypeDefinition $def
     * @throws TypeConflictException
     */
    private function verifyExtensionType(TypeDefinition $def): void
    {
        if (! $def::getType()->is(static::getType()->getName())) {
            $error = \sprintf('Type %s can extends only %s types, but %s given.', $this, static::getType(), $def);
            throw $this->error(new TypeConflictException($error));
        }
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
