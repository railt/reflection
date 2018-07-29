<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesEnumValues;
use Railt\Reflection\Contracts\Definition\Dependent\EnumValueDefinition;

/**
 * Trait HasEnumValues
 */
trait HasEnumValues
{
    /**
     * @var array|EnumValueDefinition[]
     */
    protected $values = [];

    /**
     * @return iterable|EnumValueDefinition[]
     */
    public function getValues(): iterable
    {
        return \array_values($this->values);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasValue(string $name): bool
    {
        return isset($this->values[$name]);
    }

    /**
     * @param string $name
     * @return null|EnumValueDefinition
     */
    public function getValue(string $name): ?EnumValueDefinition
    {
        return $this->values[$name] ?? null;
    }

    /**
     * @param EnumValueDefinition ...$values
     * @return ProvidesEnumValues|$this
     */
    public function withValue(EnumValueDefinition ...$values): ProvidesEnumValues
    {
        foreach ($values as $value) {
            $this->values[$value->getName()] = $value;
        }

        return $this;
    }
}
