<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\TypeDefinition;

/**
 * Interface ProvidesInheritance
 */
interface ProvidesInheritance
{
    /**
     * Returns parent type definition.
     *
     * @return TypeDefinition|null
     */
    public function getInheritedParent(): ?TypeDefinition;

    /**
     * Returns all children type definitions.
     *
     * @return iterable|TypeDefinition[]
     */
    public function inheritedBy(): iterable;

    /**
     * Returns true when type has parent type definition or false otherwise.
     *
     * @return bool
     */
    public function hasInheritance(): bool;

    /**
     * Direct inheritance checking.
     *
     * @param string|TypeDefinition $name
     * @return bool
     */
    public function extendsOf($name): bool;

    /**
     * Recursive inheritance checking.
     *
     * @param TypeDefinition|string $definition
     * @return bool
     */
    public function instanceOf($definition): bool;
}
