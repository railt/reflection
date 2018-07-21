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
use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesTypeDefinitions;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Dictionary;
use Railt\Reflection\Contracts\Document as DocumentInterface;
use Railt\Reflection\Contracts\Reflection as ReflectionInterface;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Definition\Behaviour\HasDefinitions;
use Railt\Reflection\Invocation\Behaviour\HasDirectives;

/**
 * Class Document
 */
class Document extends AbstractDefinition implements DocumentInterface
{
    use Serializable;
    use HasDirectives;
    use HasDefinitions {
        withDefinition as private __withDefinition;
    }

    /**
     * @var Readable
     */
    protected $file;

    /**
     * @var Reflection
     */
    protected $dictionary;

    /**
     * DocumentDefinition constructor.
     * @param Reflection|ReflectionInterface $parent
     * @param Readable|null $file
     */
    public function __construct(Reflection $parent, Readable $file = null)
    {
        $this->file = $file ?? File::fromSources('');
        $this->dictionary = $parent;

        parent::__construct($this);

        $parent->addDocument($this);
    }

    /**
     * @return TypeInterface
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::DOCUMENT);
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
        return $this->dictionary;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->file->isFile() ? $this->file->getPathname() : $this->file->getHash();
    }

    /**
     * @param string|TypeDefinition $type
     * @return ProvidesTypeDefinitions
     */
    public function withDefinition($type): ProvidesTypeDefinitions
    {
        if ($type instanceof TypeDefinition) {
            $this->dictionary->add($type);
        }

        return $this->__withDefinition($type);
    }
}
