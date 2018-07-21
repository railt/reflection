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
use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesTypeIndication;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Dictionary;
use Railt\Reflection\Definition\Behaviour\HasDeprecation;
use Railt\Reflection\Definition\Behaviour\HasInheritance;
use Railt\Reflection\Exception\TypeConflictException;
use Railt\Reflection\Invocation\Behaviour\HasDirectives;

/**
 * Class AbstractTypeDefinition
 */
abstract class AbstractTypeDefinition extends AbstractDefinition implements TypeDefinition
{
    use HasDirectives;
    use HasDeprecation;
    use HasInheritance;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * AbstractTypeDefinition constructor.
     * @param Document|\Railt\Reflection\Contracts\Document $document
     * @param string $name
     */
    public function __construct(Document $document, string $name)
    {
        $this->name = $name;

        parent::__construct($document);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string)$this->description;
    }

    /**
     * @param null|string $description
     * @return TypeDefinition|$this
     */
    public function withDescription(?string $description): TypeDefinition
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param string $name
     * @return TypeDefinition|$this
     */
    public function renameTo(string $name): TypeDefinition
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Dictionary
     */
    public function getDictionary(): Dictionary
    {
        return $this->document->getDictionary();
    }

    /**
     * @param TypeDefinition $definition
     * @return bool
     */
    public function instanceOf(TypeDefinition $definition): bool
    {
        if ($definition::getType()->is(Type::ANY)) {
            return true;
        }

        if ($this->getName() === $definition->getName()) {
            return true;
        }

        return $this->isExtends($definition);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return \sprintf('%s<%s>', $this->name ?? '?', static::getType());
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @param TypeDefinition $type
     * @throws ExternalFileException
     */
    protected function verifyInputType(TypeDefinition $type): void
    {
        if (! $type::getType()->isInputable()) {
            $error = 'Type %s can contains only inputable types, but %s given';
            throw $this->error(new TypeConflictException(\sprintf($error, $this, $type)));
        }
    }

    /**
     * @param TypeDefinition $type
     * @throws ExternalFileException
     */
    protected function verifyOutputType(TypeDefinition $type): void
    {
        if (! $type::getType()->isInputable()) {
            $error = 'Type %s can not be defined as return type hint of %s';
            throw $this->error(new TypeConflictException(\sprintf($error, $type, $this)));
        }
    }
}
