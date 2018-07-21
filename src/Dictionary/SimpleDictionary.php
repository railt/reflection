<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Dictionary;

use Railt\Reflection\Common\Serializable;
use Railt\Reflection\Contracts\Definition;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Dictionary;
use Railt\Reflection\Contracts\Type;
use Railt\Reflection\Exception\TypeNotFoundException;

/**
 * Class SimpleDictionary
 */
class SimpleDictionary implements Dictionary
{
    use Serializable;

    /**
     * @var array|TypeDefinition[]
     */
    protected $types = [];

    /**
     * @param Type|null $of
     * @return iterable|TypeDefinition[]
     */
    public function all(Type $of = null): iterable
    {
        foreach ($this->types as $definition) {
            if ($of === null || $definition::typeOf($of)) {
                yield $definition;
            }
        }
    }

    /**
     * @param string $name
     * @param Definition|null $from
     * @return TypeDefinition
     * @throws TypeNotFoundException
     */
    public function get(string $name, Definition $from = null): TypeDefinition
    {
        if ($result = $this->find($name)) {
            return $result;
        }

        throw $this->typeNotFound($name, $from);
    }

    /**
     * @param string $name
     * @return null|TypeDefinition
     */
    public function find(string $name): ?TypeDefinition
    {
        return $this->types[$name] ?? null;
    }

    /**
     * @param string $name
     * @param Definition|null $from
     * @return TypeNotFoundException
     */
    protected function typeNotFound(string $name, Definition $from = null): TypeNotFoundException
    {
        $error = \sprintf('Type %s<?> not found or could not be loaded', $name);

        $exception = new TypeNotFoundException($error);

        if ($from !== null) {
            $exception->throwsIn($from->getFile(), $from->getLine(), $from->getColumn());
        }

        return $exception;
    }

    /**
     * @param TypeDefinition $type
     * @return Dictionary
     */
    public function add(TypeDefinition $type): Dictionary
    {
        $this->types[$type->getName()] = $type;

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->types[$name]);
    }
}
