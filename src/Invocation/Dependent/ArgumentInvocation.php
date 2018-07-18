<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation\Dependent;

use Railt\Reflection\Contracts\Definition\Behaviour\ProvidesArguments;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Invocation\Dependent\ArgumentInvocation as ArgumentInvocationInterface;
use Railt\Reflection\Contracts\Invocation\TypeInvocation;
use Railt\Reflection\Contracts\Type;
use Railt\Reflection\Definition\Dependent\ArgumentDefinition;
use Railt\Reflection\Document;

/**
 * Class ArgumentInvocation
 */
class ArgumentInvocation extends AbstractDependentTypeInvocation implements ArgumentInvocationInterface
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * ArgumentInvocation constructor.
     * @param TypeInvocation $parent
     * @param Document $document
     * @param string $name
     * @param mixed $value
     */
    public function __construct(TypeInvocation $parent, Document $document, string $name, $value)
    {
        parent::__construct($parent, $document, $name);
    }

    /**
     * @return Type
     */
    public static function getType(): Type
    {
        return ArgumentDefinition::getType();
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return TypeDefinition
     */
    public function getTypeDefinition(): TypeDefinition
    {
        /** @var ProvidesArguments $parent */
        $parent = $this->getParent()->getTypeDefinition();

        \assert($parent instanceof ProvidesArguments);

        return $parent->getArgumentDefinition($this->name);
    }
}
