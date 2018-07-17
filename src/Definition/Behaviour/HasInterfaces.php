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
use Railt\Reflection\Exception\TypeNotFoundException;

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
     * @param TypeDefinition $definition
     * @return bool
     */
    protected function instanceOfInterface(TypeDefinition $definition): bool
    {
        foreach ($this->getInterfaces() as $interface) {
            if ($interface->instanceOf($definition)) {
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
     * @return InterfaceDefinition
     * @throws TypeNotFoundException
     */
    public function getInterface(string $name): InterfaceDefinition
    {
        if (! \in_array($name, $this->interfaces, true)) {
            $error = \sprintf('%s does not contain an interface named "%s"', $this, $name);
            throw new TypeNotFoundException($error);
        }

        return $this->fetch($name);
    }

    /**
     * @param InterfaceDefinition $definition
     */
    public function addInterface(InterfaceDefinition $definition): void
    {
        $this->interfaces[] = $definition->getName();
    }
}

