<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesInputFields;
use Railt\Reflection\Contracts\Definition\Dependent\InputFieldDefinition;

/**
 * Trait HasInputFields
 */
trait HasInputFields
{
    /**
     * @var array|InputFieldDefinition[]
     */
    protected $fields = [];

    /**
     * @return iterable|InputFieldDefinition[]
     */
    public function getFields(): iterable
    {
        return \array_values($this->fields);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasField(string $name): bool
    {
        return isset($this->fields[$name]);
    }

    /**
     * @param string $name
     * @return null|InputFieldDefinition
     */
    public function getField(string $name): ?InputFieldDefinition
    {
        return $this->fields[$name] ?? null;
    }

    /**
     * @param InputFieldDefinition ...$fields
     * @return ProvidesInputFields|$this
     */
    public function withField(InputFieldDefinition ...$fields): ProvidesInputFields
    {
        foreach ($fields as $field) {
            $this->fields[$field->getName()] = $field;
        }

        return $this;
    }

    /**
     * @param string|InputFieldDefinition ...$fields
     * @return ProvidesInputFields|$this
     */
    public function withoutField(...$fields): ProvidesInputFields
    {
        foreach ($fields as $field) {
            unset($this->fields[$this->nameOf($field)]);
        }

        return $this;
    }
}
