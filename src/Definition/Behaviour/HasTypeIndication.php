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
use Railt\Reflection\Contracts\Dictionary;

/**
 * Trait HasTypeIndication
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
    protected $modifiers = 0;

    /**
     * @return TypeDefinition
     */
    public function getDefinition(): TypeDefinition
    {
        return $this->fetch($this->definition);
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
     * @param string|TypeDefinition $type
     * @return ProvidesTypeIndication|$this
     */
    public function withTypeDefinition($type): ProvidesTypeIndication
    {
        $this->definition = $this->nameOf($type);

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $parent = $this->getDictionary()->find($this->definition) ?: $this->definition . '<?>';

        if ($this->isNonNull()) {
            $parent .= '!';
        }

        if ($this->isList()) {
            $parent = '[' . $parent . ']';
        }

        if ($this->isListOfNonNulls()) {
            $parent .= '!';
        }

        return \sprintf('%s:%s', $this->getName(), $parent);
    }

    /**
     * @return bool
     */
    public function isNonNull(): bool
    {
        return (bool)($this->modifiers & ProvidesTypeIndication::IS_NOT_NULL);
    }

    /**
     * @return bool
     */
    public function isList(): bool
    {
        return (bool)($this->modifiers & ProvidesTypeIndication::IS_LIST);
    }

    /**
     * @return bool
     */
    public function isListOfNonNulls(): bool
    {
        return (bool)($this->modifiers & ProvidesTypeIndication::IS_LIST_OF_NOT_NULL);
    }

    /**
     * @param string|TypeDefinition $type
     * @return TypeDefinition
     */
    abstract protected function fetch($type): TypeDefinition;
}
