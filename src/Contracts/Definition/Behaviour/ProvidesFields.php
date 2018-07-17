<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Dependent\FieldDefinition;

/**
 * The interface indicates that the type is a container that
 * contains a list of fields in the type.
 */
interface ProvidesFields
{
    /**
     * @return iterable|FieldDefinition[]
     */
    public function getFieldDefinitions(): iterable;

    /**
     * @param string $name
     * @return bool
     */
    public function hasFieldDefinition(string $name): bool;

    /**
     * @param string $name
     * @return FieldDefinition|null
     */
    public function getFieldDefinition(string $name): ?FieldDefinition;
}
