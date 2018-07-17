<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesFields;
use Railt\Reflection\Contracts\Definition\Dependent\FieldDefinition;
use Railt\Reflection\Exception\TypeConflictException;

/**
 * Trait HasFields
 * @mixin ProvidesFields
 */
trait HasFields
{
    /**
     * @var array|FieldDefinition[]
     */
    protected $fields = [];

    /**
     * @return iterable|FieldDefinition[]
     */
    public function getFieldDefinitions(): iterable
    {
        return \array_values($this->fields);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasFieldDefinition(string $name): bool
    {
        return isset($this->fields[$name]);
    }

    /**
     * @param string $name
     * @return null|FieldDefinition
     */
    public function getFieldDefinition(string $name): ?FieldDefinition
    {
        return $this->fields[$name] ?? null;
    }

    /**
     * @param FieldDefinition $field
     */
    public function addFieldDefinition(FieldDefinition $field): void
    {
        $this->fields[$field->getName()] = $field;
    }
}
