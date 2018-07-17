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
use Railt\Reflection\Invocation\Behaviour\HasDirectives;

/**
 * Class AbstractTypeDefinition
 */
abstract class AbstractTypeDefinition extends AbstractDefinition implements TypeDefinition
{
    use HasDirectives;
    use HasDeprecation;

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
     * @param Document $document
     * @param int $offset
     * @param string $name
     */
    public function __construct(Document $document, int $offset, string $name)
    {
        $this->name = $name;
        parent::__construct($document, $offset);
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
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param TypeDefinition $definition
     * @return bool
     */
    public function instanceOf(TypeDefinition $definition): bool
    {
        return $this instanceof $definition;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
