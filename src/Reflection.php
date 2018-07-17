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
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Document as DocumentInterface;
use Railt\Reflection\Contracts\Reflection as ReflectionInterface;
use Railt\Reflection\Contracts\Type;
use Railt\Reflection\Exception\TypeConflictException;
use Railt\Reflection\Exception\TypeNotFoundException;

/**
 * Class Reflection
 */
class Reflection implements ReflectionInterface
{
    use Serializable;

    /**
     * @var array|TypeDefinition[]
     */
    protected $types = [];

    /**
     * @var array|DocumentInterface[]
     */
    protected $documents = [];

    /**
     * @return iterable
     */
    public function getDocuments(): iterable
    {
        return \array_values($this->documents);
    }

    /**
     * @param DocumentInterface $document
     */
    public function addDocument(DocumentInterface $document): void
    {
        $this->documents[$document->getName()] = $document;
    }

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
     * @param TypeDefinition|null $from
     * @return TypeDefinition
     * @throws TypeNotFoundException
     */
    public function get(string $name, TypeDefinition $from = null): TypeDefinition
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
     * @param TypeDefinition $from
     * @return TypeNotFoundException
     */
    protected function typeNotFound(string $name, TypeDefinition $from = null): TypeNotFoundException
    {
        $error = \sprintf('Type %s not found or could not be loaded', $name);

        $exception = new TypeNotFoundException($error);

        if ($from !== null) {
            $exception->throwsIn($from->getFile(), $from->getLine(), $from->getColumn());
        }

        return $exception;
    }

    /**
     * @param TypeDefinition $type
     * @return ReflectionInterface
     */
    public function add(TypeDefinition $type): ReflectionInterface
    {
        $this->types[$type->getName()] = $type;
        $this->addDocument($type->getDocument());

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return ($this->types[$name] ?? null) !== null;
    }
}
