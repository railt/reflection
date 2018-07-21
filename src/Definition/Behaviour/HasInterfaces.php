<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesInterfaces;
use Railt\Reflection\Contracts\Definition\InterfaceDefinition;
use Railt\Reflection\Contracts\Definition\TypeDefinition;

/**
 * Trait HasInterfaces
 * @mixin ProvidesInterfaces
 */
trait HasInterfaces
{
    /**
     * @var array|string[]
     */
    protected $interfaces = [];

    /**
     * @param string|TypeDefinition $type
     * @return TypeDefinition
     */
    abstract protected function fetch($type): TypeDefinition;

    /**
     * @param string|TypeDefinition $interface
     * @return bool
     */
    public function isImplements($interface): bool
    {
        $definition = $this->fetch($interface);

        foreach ($this->getInterfaces() as $impl) {
            if ($impl->instanceOf($definition)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return iterable|InterfaceDefinition[]
     */
    public function getInterfaces(): iterable
    {
        foreach ($this->interfaces as $interface) {
            yield $this->fetch($interface);
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasInterface(string $name): bool
    {
        return \in_array($name, $this->interfaces, true);
    }

    /**
     * @param string $name
     * @return InterfaceDefinition|TypeDefinition|null
     */
    public function getInterface(string $name): ?InterfaceDefinition
    {
        return \in_array($name, $this->interfaces, true) ? $this->fetch($name) : null;
    }

    /**
     * @param InterfaceDefinition ...$interfaces
     * @return ProvidesInterfaces|$this
     */
    public function implements(InterfaceDefinition ...$interfaces): ProvidesInterfaces
    {
        foreach ($interfaces as $interface) {
            $this->interfaces[] = $interface->getName();
        }

        return $this;
    }
}

