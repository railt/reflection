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
use Railt\Reflection\Definition\Behaviour\HasDeprecation;
use Railt\Reflection\Definition\Behaviour\HasInheritance;
use Railt\Reflection\Definition\Behaviour\HasName;
use Railt\Reflection\Invocation\Behaviour\HasDirectives;

/**
 * Class AbstractTypeDefinition
 */
abstract class AbstractTypeDefinition extends AbstractDefinition implements TypeDefinition
{
    use HasName;
    use HasDirectives;
    use HasDeprecation;
    use HasInheritance;

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
        $this->renameTo($name);
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
     * @return bool
     */
    public function isBuiltin(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return \sprintf('%s<%s>', $this->name ?? '?', static::getType());
    }
}
