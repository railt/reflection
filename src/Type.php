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
use Railt\Reflection\Contracts\Type as TypeInterface;

/**
 * Class Type
 */
class Type implements TypeInterface
{
    use Serializable;

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
     * BaseType constructor.
     * @param string $name
     */
    private function __construct(string $name)
    {
        \assert(\in_array($name, \array_merge(static::DEPENDENT_TYPES, static::ROOT_TYPES), true));

        $this->name = $name;

        if (self::$inheritance === []) {
            $this->bootInheritance();
        }
    }

    /**
     * @var
     */
    private function bootInheritance(): void
    {

    }

    /**
     * @param string $type
     * @return Type
     */
    public static function of(string $type): Type
    {
        return self::$instances[$type] ?? (self::$instances[$type] = new static($type));
    }

    /**
     * @return bool
     */
    public function isDependent(): bool
    {
        return \in_array($this->name, static::DEPENDENT_TYPES, true);
    }

    /**
     * @param TypeInterface $type
     * @return bool
     */
    public function instanceOf(TypeInterface $type): bool
    {
        return $this instanceof $type;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
