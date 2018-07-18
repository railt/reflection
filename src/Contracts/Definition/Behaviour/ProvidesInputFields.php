<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Dependent\InputFieldDefinition;


/**
 * The interface indicates that the type is a container that
 * contains a list of valid input fields in the type.
 */
interface ProvidesInputFields
{
    /**
     * @return iterable|InputFieldDefinition[]
     */
    public function getFields(): iterable;

    /**
     * @param string $name
     * @return bool
     */
    public function hasField(string $name): bool;

    /**
     * @param string $name
     * @return InputFieldDefinition|null
     */
    public function getField(string $name): ?InputFieldDefinition;
}
