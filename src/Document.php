<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection;

use Railt\Io\File;
use Railt\Io\Readable;
use Railt\Reflection\Common\Renderer;
use Railt\Reflection\Common\Serializable;
use Railt\Reflection\Contracts\Definition\SchemaDefinition;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Document as DocumentInterface;
use Railt\Reflection\Contracts\Reflection as ReflectionInterface;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Invocation\Behaviour\HasDirectives;

/**
 * Class Document
 */
class Document extends AbstractDefinition implements DocumentInterface
{
    use Serializable;
    use HasDirectives;

    /**
     * @var Readable
     */
    protected $file;

    /**
     * @var Reflection
     */
    protected $store;

    /**
     * @var array|string[]
     */
    protected $types = [];

    /**
     * DocumentDefinition constructor.
     * @param Reflection|ReflectionInterface $parent
     * @param Readable|null $file
     */
    public function __construct(Reflection $parent, Readable $file = null)
    {
        $this->file  = $file ?? File::fromSources('');
        $this->store = $parent;

        parent::__construct($this, 0);
    }

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::DOCUMENT);
    }

    /**
     * @param TypeDefinition $type
     * @throws \Railt\Io\Exception\ExternalFileException
     * @throws \Railt\Reflection\Exception\TypeConflictException
     */
    public function addTypeDefinition(TypeDefinition $type): void
    {
        $this->store->addType($type);
        $this->types[] = $type->getName();
    }

    /**
     * @return Readable
     */
    public function getFile(): Readable
    {
        return $this->file;
    }

    /**
     * @return ReflectionInterface|Reflection
     */
    public function getReflection(): ReflectionInterface
    {
        return $this->store;
    }

    /**
     * @return bool
     */
    public function isDeprecated(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function getDeprecationReason(): string
    {
        return '';
    }

    /**
     * @return iterable
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public function getTypeDefinitions(): iterable
    {
        foreach ($this->types as $type) {
            yield $this->fetch($type);
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasTypeDefinition(string $name): bool
    {
        return \in_array($name, $this->types, true);
    }

    /**
     * @param string $name
     * @return TypeDefinition
     */
    public function getTypeDefinition(string $name): TypeDefinition
    {
        if (! \in_array($name, $this->types, true)) {
            return null;
        }

        return $this->store->getTypeDefinition($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        $name = \basename($this->file->getPathname());

        return Renderer::typeName(\explode('.', $name)[0]);
    }

    /**
     * @return int
     */
    public function getNumberOfTypeDefinitions(): int
    {
        return \count($this->types);
    }
}
