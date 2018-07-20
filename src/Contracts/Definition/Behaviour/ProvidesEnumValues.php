<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Contracts\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Dependent\EnumValueDefinition;

/**
 * Interface ProvidesEnumValues
 */
interface ProvidesEnumValues
{
    /**
     * @return iterable|EnumValueDefinition[]
     */
    public function getValues(): iterable;

    /**
     * @param string $name
     * @return bool
     */
    public function hasValue(string $name): bool;

    /**
     * @param string $name
     * @return EnumValueDefinition|null
     */
    public function getValue(string $name): ?EnumValueDefinition;
}
