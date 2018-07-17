<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection;

use Railt\Reflection\Common\Renderer;
use Railt\Reflection\Common\Serializable;
use Railt\Reflection\Contracts\Type as TypeInterface;

/**
 * Class BaseType
 */
abstract class Type implements TypeInterface
{
    use Serializable;

    /**
     * @var Type[]
     */
    private static $instances = [];

    /**
     * @var array
     */
    private static $types = [];

    /**
     * @var string
     */
    protected $name;

    /**
     * BaseType constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $type
     * @return Type
     */
    public static function of(string $type): Type
    {
        return self::$instances[$type] ?? (
            self::$instances[$type] = new static($type)
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
        return Renderer::typeName($this->getName());
    }

    /**
     * @param string $name
     * @return bool
     * @throws \ReflectionException
     */
    public static function isValid(string $name): bool
    {
        if (self::$types === []) {
            $reflection = new \ReflectionClass(static::class);

            foreach ($reflection->getConstants() as $constant) {
                self::$types[] = $constant;
            }
        }

        return \in_array($name, self::$types, true);
    }
}
