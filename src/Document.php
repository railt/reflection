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
use Railt\Reflection\Common\Serializable;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Dictionary;
use Railt\Reflection\Contracts\Document as DocumentInterface;
use Railt\Reflection\Contracts\Reflection as ReflectionInterface;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Exception\TypeNotFoundException;
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
        $this->file = $file ?? File::fromSources('');
        $this->store = $parent;

        parent::__construct($this);

        $parent->addDocument($this);
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
     * @return DocumentInterface
     */
    public function withDefinition(TypeDefinition $type): DocumentInterface
    {
        $this->store->add($type);

        $this->types[] = $type->getName();

        return $this;
    }

    /**
     * @return Readable
     */
    public function getFile(): Readable
    {
        return $this->file;
    }

    /**
     * @return ReflectionInterface|Reflection|Dictionary
     */
    public function getDictionary(): Dictionary
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
     * @return iterable|TypeDefinition[]
     * @throws TypeNotFoundException
     */
    public function getDefinitions(): iterable
    {
        foreach ($this->types as $type) {
            yield $this->store->get($type);
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasDefinition(string $name): bool
    {
        return \in_array($name, $this->types, true);
    }

    /**
     * @param string $name
     * @return null|TypeDefinition
     */
    public function getDefinition(string $name): ?TypeDefinition
    {
        if (! \in_array($name, $this->types, true)) {
            return null;
        }

        return $this->store->find($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->file->isFile() ? $this->file->getPathname() : $this->file->getHash();
    }
}
