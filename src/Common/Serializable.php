<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Common;

/**
 * Trait Serializable
 */
trait Serializable
{
    /**
     * @return array
     */
    public function __sleep(): array
    {
        return \array_keys(\iterator_to_array($this->getObjectFields()));
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        return \iterator_to_array($this->getObjectFields());
    }

    /**
     * @return iterable|\Generator
     */
    protected function getObjectFields(): iterable
    {
        $reflection = new \ReflectionObject($this);

        $flags = \ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PUBLIC;

        foreach ($reflection->getProperties($flags) as $field) {
            $field->setAccessible(true);

            yield $field->getName() => $field->getValue($this);
        }
    }
}
