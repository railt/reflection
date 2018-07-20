<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Behaviour;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesTypeIndication;
use Railt\Reflection\Contracts\Definition\TypeDefinition;

/**
 * Trait HasTypeIndication
 * @mixin ProvidesTypeIndication
 */
trait HasTypeIndication
{
    /**
     * @var string
     */
    protected $definition;

    /**
     * @var int
     */
    protected $modifiers = 0b0000;

    /**
     * @return TypeDefinition
     */
    public function getDefinition(): TypeDefinition
    {
        \assert(\is_string($this->definition));

        return $this->fetch($this->definition);
    }

    /**
     * @return bool
     */
    public function isList(): bool
    {
        return ProvidesTypeIndication::IS_LIST ===
            ($this->modifiers & ProvidesTypeIndication::IS_LIST);
    }

    /**
     * @return bool
     */
    public function isNonNull(): bool
    {
        return ProvidesTypeIndication::IS_NOT_NULL ===
            ($this->modifiers & ProvidesTypeIndication::IS_NOT_NULL);
    }

    /**
     * @return bool
     */
    public function isListOfNonNulls(): bool
    {
        return ProvidesTypeIndication::IS_LIST_OF_NOT_NULL ===
            ($this->modifiers & ProvidesTypeIndication::IS_LIST_OF_NOT_NULL);
    }

    /**
     * @param int ...$values
     * @return ProvidesTypeIndication|$this
     */
    public function withModifiers(int ...$values): ProvidesTypeIndication
    {
        foreach ($values as $value) {
            $this->modifiers |= $value;
        }

        return $this;
    }

    /**
     * @param string $name
     * @return ProvidesTypeIndication|$this
     */
    public function withTypeDefinition(string $name): ProvidesTypeIndication
    {
        $this->definition = $name;
        
        return $this;
    }
}
