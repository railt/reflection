<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Definition\Dependent;

use Railt\Reflection\Contracts\Definition\Dependent\ArgumentDefinition as ArgumentDefinitionInterface;
use Railt\Reflection\Contracts\Definition\TypeDefinition;
use Railt\Reflection\Contracts\Type as TypeInterface;
use Railt\Reflection\Definition\Behaviour\HasTypeIndication;
use Railt\Reflection\Document;
use Railt\Reflection\Type;

/**
 * Class ArgumentDefinition
 */
class ArgumentDefinition extends AbstractDependentTypeDefinition implements ArgumentDefinitionInterface
{
    use HasTypeIndication;

    /**
     * @var mixed
     */
    protected $defaultValue;

    /**
     * @var bool
     */
    protected $hasDefaultValue = false;

    /**
     * ArgumentDefinition constructor.
     * @param TypeDefinition $parent
     * @param Document $document
     * @param string $name
     * @param string $type
     */
    public function __construct(TypeDefinition $parent, Document $document, string $name, string $type)
    {
        parent::__construct($parent, $document, $name);

        $this->withTypeDefinition($type);
    }

    /**
     * @return TypeInterface
     */
    public static function getType(): TypeInterface
    {
        return Type::of(Type::ARGUMENT);
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param mixed $value
     * @return ArgumentDefinitionInterface|$this
     */
    public function withDefaultValue($value): ArgumentDefinitionInterface
    {
        $this->defaultValue    = $value;
        $this->hasDefaultValue = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasDefaultValue(): bool
    {
        return $this->hasDefaultValue;
    }

    /**
     * @return ArgumentDefinitionInterface
     */
    public function withoutDefaultValue(): ArgumentDefinitionInterface
    {
        $this->defaultValue    = null;
        $this->hasDefaultValue = false;

        return $this;
    }
}
