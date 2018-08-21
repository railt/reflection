<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection;

use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Document as DocumentInterface;
use Railt\Reflection\Contracts\Invocation\TypeInvocation;
use Railt\Reflection\Definition\Behaviour\HasName;

/**
 * Class AbstractTypeInvocation
 */
abstract class AbstractTypeInvocation extends AbstractDefinition implements TypeInvocation
{
    use HasName;

    /**
     * AbstractTypeInvocation constructor.
     * @param Document|DocumentInterface $document
     * @param string|null $name
     */
    public function __construct(Document $document, ?string $name)
    {
        $this->renameTo($name);
        parent::__construct($document);
    }

    /**
     * @return TypeDefinition
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public function getDefinition(): TypeDefinition
    {
        return $this->fetch($this->getName());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return \sprintf('%s<%s>()', $this->getName(), static::getType());
    }
}
