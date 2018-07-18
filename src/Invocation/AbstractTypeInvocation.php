<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation;

use Railt\Reflection\AbstractDefinition;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Invocation\TypeInvocation;
use Railt\Reflection\Document;

/**
 * Class AbstractTypeInvocation
 */
abstract class AbstractTypeInvocation extends AbstractDefinition implements TypeInvocation
{
    /**
     * @var string
     */
    protected $name;

    /**
     * AbstractTypeInvocation constructor.
     * @param Document $document
     * @param string $name
     */
    public function __construct(Document $document, string $name)
    {
        $this->name = $name;

        parent::__construct($document);
    }

    /**
     * @return TypeDefinition
     */
    public function getDefinition(): TypeDefinition
    {
        return $this->fetch($this->name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return \sprintf('%s()<%s>', $this->getName(), static::getType());
    }
}
