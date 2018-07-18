<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection;

use Railt\Io\Readable;
use Railt\Reflection\Common\Serializable;
use Railt\Reflection\Contracts\Definition;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Document as DocumentInterface;
use Railt\Reflection\Contracts\Invocation\TypeInvocation;
use Railt\Reflection\Contracts\Type as TypeInterface;

/**
 * Class AbstractDefinition
 */
abstract class AbstractDefinition implements Definition
{
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
     * AbstractDefinition constructor.
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * @param TypeInterface $type
     * @return bool
     */
    public static function typeOf(TypeInterface $type): bool
    {
        return static::getType()->instanceOf($type);
    }

    /**
     * @param int $offset
     * @return Definition|TypeDefinition|TypeInvocation|$this
     */
    public function withOffset(int $offset): Definition
    {
        $this->offset = $offset;

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
        return $this->getFile()->getPosition($this->offset)->getLine();
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
        return $this->getFile()->getPosition($this->offset)->getColumn();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return \sprintf('?<%s>', static::getType());
    }

    /**
     * @param string $type
     * @return TypeDefinition
     */
    protected function fetch(string $type): TypeDefinition
    {
        return $this->document->getDictionary()->get($type, $this);
    }
}
