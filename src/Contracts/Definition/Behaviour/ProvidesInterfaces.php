<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\InterfaceDefinition;

/**
 * Interface ProvidesInterfaces
 */
interface ProvidesInterfaces
{
    /**
     * @return iterable|InterfaceDefinition[]
     */
    public function getInterfaces(): iterable;

    /**
     * @param string $name
     * @return bool
     */
    public function hasInterface(string $name): bool;

    /**
     * @param string $name
     * @return InterfaceDefinition|null
     */
    public function getInterface(string $name): ?InterfaceDefinition;

    /**
     * @param string $name
     * @return bool
     */
    public function isImplements(string $name): bool;
}
