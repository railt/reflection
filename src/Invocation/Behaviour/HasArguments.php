<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation\Behaviour;

use Railt\Reflection\Contracts\Invocation\Behaviour\ProvidesArguments;

/**
 * Trait HasArguments
 */
trait HasArguments
{
    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        foreach ($this->arguments as $name => $value) {
            yield $name => $value;
        }
    }

    /**
     * @param string|int $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return $this->hasArgument($offset);
    }

    /**
     * @param string|int $name
     * @return bool
     */
    public function hasArgument($name): bool
    {
        return isset($this->arguments[$name]) && \array_key_exists($name, $this->arguments);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->getArgument($offset);
    }

    /**
     * @param string|int $name
     * @return mixed|null
     */
    public function getArgument($name)
    {
        return $this->arguments[$name] ?? null;
    }

    /**
     * @param string|int $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->withArgument($offset, $value);
    }

    /**
     * @param string|int $name
     * @param mixed $value
     * @return ProvidesArguments
     */
    public function withArgument($name, $value): ProvidesArguments
    {
        $this->arguments[$name] = $value;

        return $this;
    }

    /**
     * @param string|int $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->arguments[$offset]);
    }

    /**
     * @return iterable
     */
    public function getArguments(): iterable
    {
        return $this->arguments;
    }
}
