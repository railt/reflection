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
use Railt\Io\Readable;
use Railt\Reflection\Common\Jsonable;
use Railt\Reflection\Common\Serializable;
use Railt\Reflection\Contracts\Definition;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Document as DocumentInterface;
use Railt\Reflection\Contracts\Invocation\TypeInvocation;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Exception\ReflectionException;

/**
 * Class AbstractDefinition
 */
abstract class AbstractDefinition implements Definition, \JsonSerializable
{
    use Jsonable;
    use Serializable;

    /**
     * @var Document
     */
    protected $document;

    /**
     * @var int
     */
    protected $offset = 0;

    /**
     * @var int|null
     */
    protected $line;

    /**
     * @var int|null
     */
    protected $column;

    /**
     * AbstractDefinition constructor.
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * @param TypeInterface|string $type
     * @return bool
     * @throws ReflectionException
     */
    public static function typeOf($type): bool
    {
        switch (true) {
            case $type instanceof TypeInterface:
                break;
            case \is_string($type):
                $type = Type::of($type);
                break;
            default:
                throw new ReflectionException('Unsupported argument');
        }

        return static::getType()->instanceOf($type);
    }

    /**
     * @param int $offset
     * @return Definition|TypeDefinition|TypeInvocation|$this
     */
    public function withOffset(int $offset): Definition
    {
        $this->offset = $offset;

        [$this->line, $this->column] = null;

        return $this;
    }

    /**
     * @param int $line
     * @return Definition|TypeDefinition|TypeInvocation|$this
     */
    public function withLine(?int $line): Definition
    {
        $this->line = \is_int($line) ? \max(1, $line) : $line;

        return $this;
    }

    /**
     * @param int $column
     * @return Definition|TypeDefinition|TypeInvocation|$this
     */
    public function withColumn(?int $column): Definition
    {
        $this->column = \is_int($column) ? \max(1, $column) : $column;

        return $this;
    }

    /**
     * @return DocumentInterface
     */
    public function getDocument(): DocumentInterface
    {
        return $this->document;
    }

    /**
     * @return int
     */
    public function getLine(): int
    {
        if ($this->line === null) {
            $this->line = $this->getFile()->getPosition($this->offset)->getLine();
        }

        return $this->line;
    }

    /**
     * @return Readable
     */
    public function getFile(): Readable
    {
        return $this->document->getFile();
    }

    /**
     * @return int
     */
    public function getColumn(): int
    {
        if ($this->column === null) {
            $this->column = $this->getFile()->getPosition($this->offset)->getColumn();
        }

        return $this->column;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return \sprintf('?<%s>', static::getType());
    }

    /**
     * @param string|TypeDefinition $type
     * @return TypeDefinition
     * @throws ExternalFileException
     */
    protected function fetch($type): TypeDefinition
    {
        switch (true) {
            case \is_string($type):
                return $this->document->getDictionary()->get($type, $this);

            case $type instanceof TypeDefinition:
                return $type;
        }

        throw (new ReflectionException('Unsupported argument'))
            ->throwsIn($this->getFile(), $this->getLine(), $this->getColumn());
    }

    /**
     * @param string|TypeDefinition $type
     * @return string|null
     * @throws ExternalFileException
     */
    protected function nameOf($type): ?string
    {
        switch (true) {
            case \is_string($type):
                return $type;

            case $type instanceof TypeDefinition:
                return $type->getName();
        }

        throw (new ReflectionException('Unsupported argument'))
            ->throwsIn($this->getFile(), $this->getLine(), $this->getColumn());
    }

    /**
     * @param string|TypeDefinition|null $type
     * @return null|TypeDefinition
     * @throws ExternalFileException
     */
    protected function fetchOrNull($type): ?TypeDefinition
    {
        return $type === null ? $this->fetch($type) : null;
    }

    /**
     * @param \Throwable $error
     * @return ExternalFileException
     */
    protected function error(\Throwable $error): ExternalFileException
    {
        if (! $error instanceof ExternalFileException) {
            $error = new ReflectionException($error->getMessage(), $error->getCode(), $error);
        }

        return $error->throwsIn($this->getFile(), $this->getLine(), $this->getColumn());
    }
}
