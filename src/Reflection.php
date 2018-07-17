<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection;

use Railt\Io\Exception\ExternalFileException;
use Railt\Reflection\Common\Serializable;
use Railt\Reflection\Contracts\Definition;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Document as DocumentInterface;
use Railt\Reflection\Contracts\Definition\SchemaDefinition as SchemaInterface;
use Railt\Reflection\Contracts\Reflection as ReflectionInterface;
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
     * @var array|string[]
     */
    protected $schema = [];

    /**
     * @return iterable|DocumentInterface[]
     */
    public function getDocuments(): iterable
    {
        return \array_values($this->documents);
    }

    /**
     * @param string|null $name
     * @return null|SchemaInterface|TypeDefinition
     */
    public function getSchema(string $name = null): ?SchemaInterface
    {
        $name = $name ?? SchemaInterface::DEFAULT_SCHEMA_NAME;

        if (! \in_array($name, $this->schema, true)) {
            return null;
        }

        return $this->getTypeDefinition($name);
    }

    /**
     * @param string $name
     * @return TypeDefinition
     */
    public function getTypeDefinition(string $name): ?TypeDefinition
    {
        return $this->types[$name] ?? null;
    }

    /**
     * @param string $type
     * @param Definition $from
     * @return TypeDefinition
     * @throws ExternalFileException
     */
    public function fetch(string $type, Definition $from): TypeDefinition
    {
        if (($result = $this->getTypeDefinition($type)) !== null) {
            return $result;
        }

        throw $this->typeNotFound($type)
            ->throwsIn($from->getFile(), $from->getLine(), $from->getColumn());
    }

    /**
     * @param string $name
     * @return TypeNotFoundException
     */
    private function typeNotFound(string $name): TypeNotFoundException
    {
        $error = \sprintf('Type %s not found or could not be loaded', $name);

        return new TypeNotFoundException($error);
    }

    /**
     * @param TypeDefinition $type
     * @throws ExternalFileException|TypeConflictException
     */
    public function addType(TypeDefinition $type): void
    {
        $this->checkTypeExistence($type);

        $this->preCacheSchema($type);
        $this->preCacheDocument($type);

        $this->types[$type->getName()] = $type;
    }

    /**
     * @param TypeDefinition $type
     * @throws ExternalFileException
     * @throws TypeConflictException
     */
    private function checkTypeExistence(TypeDefinition $type): void
    {
        if (\array_key_exists($type->getName(), $this->types)) {
            throw $this->typeRedefinition($type);
        }
    }

    /**
     * @param TypeDefinition $type
     * @return TypeConflictException|ExternalFileException
     */
    private function typeRedefinition(TypeDefinition $type): TypeConflictException
    {
        $def = $this->types[$type->getName()];

        $error = 'Could not define type %s, because type with same name already has been defined in %s:%d:%d';
        $error = \sprintf($error, $type, $def->getFile()->getPathname(), $def->getLine(), $def->getColumn());

        return (new TypeConflictException($error))->throwsIn($type->getFile(), $type->getLine(), $type->getColumn());
    }

    /**
     * @param TypeDefinition $type
     */
    private function preCacheSchema(TypeDefinition $type): void
    {
        if ($type instanceof SchemaInterface) {
            $this->schema[] = $type->getName();
        }
    }

    /**
     * @param TypeDefinition $type
     */
    private function preCacheDocument(TypeDefinition $type): void
    {
        $document = $type->getDocument();

        if (! \array_key_exists($document->getName(), $this->documents)) {
            $this->documents[$document->getName()] = $document;
        }
    }

    /**
     * @return iterable|TypeDefinition[]
     */
    public function getTypeDefinitions(): iterable
    {
        return \array_values($this->types);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasTypeDefinition(string $name): bool
    {
        return \array_key_exists($name, $this->types);
    }

    /**
     * @return int
     */
    public function getNumberOfTypeDefinitions(): int
    {
        return \count($this->types);
    }
}
