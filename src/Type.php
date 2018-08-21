<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection;

use Railt\Reflection\Common\Serializable;
use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesType;
use Railt\Reflection\Contracts\TypeInterface;

/**
 * Class Type
 */
class Type implements TypeInterface
{
    use Serializable;

    /**
     * @var array|string[]
     */
    private const TYPES_LIST = self::DEPENDENT_TYPES + self::ROOT_TYPES;

    /**
     * @var Type[]
     */
    private static $instances = [];

    /**
     * @var array[]|string[][]
     */
    private static $inheritance = [];

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array|string[]
     */
    private $parent;

    /**
     * BaseType constructor.
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->name   = $name;
        $this->parent = $this->getInheritanceSequence($name);
    }

    /**
     * @param string $name
     * @return array
     */
    private function getInheritanceSequence(string $name): array
    {
        if (self::$inheritance === []) {
            $this->bootInheritance(new \SplStack(), static::INHERITANCE_TREE);
        }

        return self::$inheritance[$name] ?? [static::ROOT_TYPE];
    }

    /**
     * @param \SplStack $stack
     * @param array $children
     */
    private function bootInheritance(\SplStack $stack, array $children = []): void
    {
        $push = function (string $type) use ($stack): void {
            self::$inheritance[$type]   = \array_values(\iterator_to_array($stack));
            self::$inheritance[$type][] = static::ROOT_TYPE;

            $stack->push($type);
        };

        foreach ($children as $type => $child) {
            switch (true) {
                case \is_string($child):
                    $push($child);
                    break;

                case \is_array($child):
                    $push($type);
                    $this->bootInheritance($stack, $child);
                    break;
            }

            $stack->pop();
        }
    }

    /**
     * @param string|ProvidesType $type
     * @return Type|\Railt\Reflection\Contracts\TypeInterface
     */
    public static function of($type): Type
    {
        switch (true) {
            case \is_string($type):
                return self::$instances[$type] ?? (self::$instances[$type] = new static($type));

            case $type instanceof ProvidesType:
                return $type::getType();
        }

        return static::of(static::ANY);
    }

    /**
     * {@inheritDoc}
     */
    public function isInputable(): bool
    {
        return \in_array($this->name, static::ALLOWS_TO_INPUT, true);
    }

    /**
     * {@inheritDoc}
     */
    public function isReturnable(): bool
    {
        return \in_array($this->name, static::ALLOWS_TO_OUTPUT, true);
    }

    /**
     * {@inheritDoc}
     */
    public function isDependent(): bool
    {
        return \in_array($this->name, static::DEPENDENT_TYPES, true);
    }

    /**
     * {@inheritDoc}
     */
    public function instanceOf(TypeInterface $type): bool
    {
        $needle = $type->getName();

        return $this->is($needle) || \in_array($needle, $this->parent, true);
    }

    /**
     * {@inheritDoc}
     */
    public function is(string $type): bool
    {
        return $this->getName() === $type;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * {@inheritDoc}
     */
    public static function isValid(string $name): bool
    {
        return \in_array($name, self::TYPES_LIST, true);
    }
}
